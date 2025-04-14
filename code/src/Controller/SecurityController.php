<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Client;
use App\Entity\ServiceClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Uid\Uuid;
use App\Repository\UserRepository;
use App\DTO\ForgotPasswordDTO;
use App\Form\ForgotPasswordType;
use App\DTO\ResetPasswordDTO;
use App\Form\ResetPasswordType;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SecurityController extends AbstractController
{
    #[Route('/mot-de-passe-oublie', name: 'app_forgot_password')]
    public function forgotPassword(Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        // Instancier le DTO
        $forgotPasswordDTO = new ForgotPasswordDTO();

        // Créer le formulaire
        $form = $this->createForm(ForgotPasswordType::class, $forgotPasswordDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $email = $data->getEmail();

            // Vérifiez si l'e-mail existe pour un client ou un service client
            $user = $em->getRepository(Client::class)->findOneBy(['email' => $email])
                ?? $em->getRepository(ServiceClient::class)->findOneBy(['email' => $email]);

            if ($user) {
                // Générer un token unique
                $token = Uuid::v4();
                $user->setResetToken($token);
                $user->setTokenExpiration((new \DateTime())->modify('+1 hour'));
                $em->flush();

                // Générer l'URL pour la réinitialisation du mot de passe
                $resetUrl = $this->generateUrl('app_reset_password', ['token' => $token], true);

                // Préparer l'email
                $emailMessage = (new Email())
                    ->from('siham.bensalah18@gmail.com')  // Adresse d'expéditeur
                    ->to($email)  // Adresse de destinataire
                    ->subject('Réinitialisation de votre mot de passe')
                    ->text("Cliquez sur le lien suivant pour réinitialiser votre mot de passe : $resetUrl");

                // Essayer d'envoyer l'email
                try {
                    $mailer->send($emailMessage);
                    $this->addFlash('success', 'An email has been sent to reset your password.');
                } catch (\Exception $e) {
                    // Si une erreur survient lors de l'envoi, afficher un message d'erreur
                    $this->addFlash('error', 'Error sending the email: ' . $e->getMessage());
                }
            } else {
                // Si l'utilisateur n'existe pas
                $this->addFlash('error', 'No user found with this email.');
            }
        }

        return $this->render('security/forgot_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reinitialisation/{token}', name: 'app_reset_password')]
    public function resetPassword(string $token, Request $request, EntityManagerInterface $em, ValidatorInterface $validator, UserRepository $userRepository): Response
    {
        // Trouver l'utilisateur associé au token
        $user = $userRepository->findUserByResetToken($token);

        // Vérifier si le token est invalide ou expiré
        if (!$user || $user->getTokenExpiration() < new \DateTime()) {
            $this->addFlash('error', 'The link is invalid or expired.');
            return $this->redirectToRoute('app_forgot_password');
        }

        // Créer le DTO et le formulaire
        $resetPasswordDTO = new ResetPasswordDTO();
        $form = $this->createForm(ResetPasswordType::class, $resetPasswordDTO);
        $form->handleRequest($request);

        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Validation manuelle du DTO
            $errors = $validator->validate($resetPasswordDTO);

            if (count($errors) > 0) {
                // Ajouter des erreurs de validation au message flash
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
                return $this->render('security/reset_password.html.twig', [
                    'form' => $form->createView(),
                    'token' => $token,
                ]);
            }

            // Récupérer et hasher le nouveau mot de passe
            $newPassword = $resetPasswordDTO->getPassword();
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            // Mettre à jour l'utilisateur avec le nouveau mot de passe
            $userRepository->updateUserPassword($user, $hashedPassword);

            // Rediriger l'utilisateur après la réinitialisation réussie
            $this->addFlash('success', 'Your password has been reset successfully.');
            return $this->redirectToRoute('app_login');
        }

        // Rendre la vue avec le formulaire
        return $this->render('security/reset_password.html.twig', [
            'form' => $form->createView(),
            'token' => $token,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response
    {
        // Symfony gère la déconnexion automatiquement, pas besoin d'un service personnalisé ici.
        return $this->redirectToRoute('app_home');
    }
}
