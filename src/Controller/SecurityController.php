<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\RegistrationType;
use App\Form\LoginType;
use App\Service\RegistrationMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class SecurityController extends AbstractController {

    public function __construct(
        private FormFactoryInterface $formFactory,
        private EntityManagerInterface $entityManager,
        RegistrationMailer $mailer,
        private TokenGeneratorInterface $tokenGenerator
    ) {
        $this->mailer = $mailer;
    }

    #[Route('/registration', name: 'registration', methods: ['GET', 'POST'])]
    public function registration(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $form = $this->formFactory->create(RegistrationType::class)
                                  ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $passwordHashed = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($passwordHashed);
            $user->setToken($this->tokenGenerator->generateToken());

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->mailer->sendEmail($user->getEmail(), $user->getToken());

            return $this->redirectToRoute('homepage');
        }

        return $this->render('security/registration.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/confirm-account/{token}', name: 'confirm_account', methods: ['GET', 'POST'])]
    public function confirmAccount(string $token, UserRepository $userRepository)
    {
        $user = $userRepository->findOneBy(['token' => $token]);
        $user->setToken($token);
        $user->setIsVerified(true);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $form = $this->formFactory->create(LoginType::class);
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render(
            'security/login.html.twig',
            [
                'form' => $form->createView(),
                'error' => $error
            ]
        );
    }

    #[Route('/forgot-password', name: 'forgot_password', methods: ['GET', 'POST'])]
    public function forgotPassword(): Response
    {
        return $this->render('security/forgotPassword.html.twig');
    }

    #[Route('/recover-password', name: 'recover_password', methods: ['GET', 'POST'])]
    public function recoverPassword(): Response
    {
        return $this->render('security/recoverPassword.html.twig');
    }
}