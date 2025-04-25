<?php
namespace App\Controller\MechanicsController;

use App\DTO\LoginDTO;
use App\Form\LoginType;
use App\Repository\MechanicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use App\Security\MechanicAuthenticator;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class LoginController extends AbstractController
{
    #[Route('/mechanic/login', name: 'mechanic_login')]
    public function login(
        Request $request,
        MechanicRepository $mechanicRepository,
        UserPasswordHasherInterface $passwordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        MechanicAuthenticator $authenticator
    ): Response {
        $loginDTO = new LoginDTO();
        $form = $this->createForm(LoginType::class, $loginDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mechanic = $mechanicRepository->findOneBy(['email' => $loginDTO->email]);

            if (!$mechanic || !$passwordHasher->isPasswordValid($mechanic, $loginDTO->password)) {
                $this->addFlash('error', 'Incorect Email or password .');
            } else {
                return $userAuthenticator->authenticateUser(
                    $mechanic,
                    $authenticator,
                    $request
                );
            }
        }

        return $this->render('mechanics/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
