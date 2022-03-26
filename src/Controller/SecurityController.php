<?php

namespace App\Controller;

use App\Form\RegistrationType;
use App\Form\LoginType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController {

    public function __construct(
        private FormFactoryInterface $formFactory,
        private EntityManagerInterface $entityManager
    ) {
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

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('security/registration.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
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