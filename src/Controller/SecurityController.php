<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController {

    #[Route('/registration', name: 'registration', methods: ['GET', 'POST'])]
    public function registration(UserRepository $userRepository): Response
    {
        return $this->render('security/registration.html.twig');
    }

    #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
    public function login(UserRepository $userRepository): Response
    {
        return $this->render('security/login.html.twig');
    }
}