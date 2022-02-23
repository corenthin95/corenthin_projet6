<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage', methods: ['GET', 'POST'])]
    public function index(TrickRepository $trickRepository): Response
    {
        $tricks = $trickRepository->findAll();
        return $this->render('home.html.twig', ['tricks' => $tricks]);
    }
}