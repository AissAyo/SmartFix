<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Client;
use App\Entity\Garagiste;
use App\Entity\Admin;
use App\Entity\ClientService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Uid\Uuid;

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
        if ($request->isMethod('POST')) {
            $data = $form->getData();

            $email = $data->getEmail();
    
            // Vérifiez si l'e-mail existe pour un client, garagiste, admin ou clientService
            $user = $em->getRepository(Client::class)->findOneBy(['email' => $email])
                ?? $em->getRepository(Garagiste::class)->findOneBy(['email' => $email])
                ?? $em->getRepository(Admin::class)->findOneBy(['email' => $email])
                ?? $em->getRepository(ClientService::class)->findOneBy(['email' => $email]);
    
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
                    $this->addFlash('success', 'Un email a été envoyé pour réinitialiser votre mot de passe.');
                } catch (\Exception $e) {
                    // Si une erreur survient lors de l'envoi, afficher un message d'erreur
                    $this->addFlash('error', 'Erreur lors de l\'envoi de l\'email: ' . $e->getMessage());
                }
            } else {
                // Si l'utilisateur n'existe pas
                $this->addFlash('error', 'Aucun utilisateur trouvé avec cet e-mail.');
            }
        }
    
        
        return $this->render('security/forgot_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/reinitialisation/{token}', name: 'app_reset_password')]
    public function resetPassword(string $token, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {
        // Trouver l'utilisateur associé au token
        $user = $em->getRepository(Client::class)->findOneBy(['resetToken' => $token])
            ?? $em->getRepository(Garagiste::class)->findOneBy(['resetToken' => $token])
            ?? $em->getRepository(Admin::class)->findOneBy(['resetToken' => $token])
            ?? $em->getRepository(ClientService::class)->findOneBy(['resetToken' => $token]);
    
        // Vérifier si le token est invalide ou expiré
        if (!$user || $user->getTokenExpiration() < new \DateTime()) {
            $this->addFlash('error', 'Le lien est invalide ou expiré.');
            return $this->redirectToRoute('app_forgot_password');
        }
    
        // Créer le DTO et le formulaire
        $resetPasswordDTO = new ResetPasswordDTO();
        $form = $this->createForm(ResetPasswordType::class, $resetPasswordDTO);
    
        $form->handleRequest($request);
    
        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
           // $errors = $validator->validate($resetPasswordDTO);
            //dump($errors); // Débogage : voir les erreurs de validation
           // die();
            // Récupérer et hasher le nouveau mot de passe
            $newPassword = $resetPasswordDTO->getPassword();
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    
            // Mettre à jour l'utilisateur
            $user->setPassword($hashedPassword);
            $user->setResetToken(null); // Supprimer le token
            $user->setTokenExpiration(null); // Supprimer la date d'expiration
            $em->flush();
    
            //$this->addFlash('success', 'Votre mot de passe a été réinitialisé avec succès.');
            return $this->redirectToRoute('app_login');
        }
    
        // Rendre la vue avec le formulaire
        return $this->render('security/reset_password.html.twig', [
            'form' => $form->createView(),
            'token' => $token,
        ]);
    }
    
}
