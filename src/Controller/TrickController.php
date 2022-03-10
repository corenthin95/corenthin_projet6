<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    #[Route('/trick/{id}', name: 'show_trick', methods: ['GET', 'POST'])]
    public function showTrick(string $id, TrickRepository $trickRepository): Response
    {
        $trick = $trickRepository->find($id);
        return $this->render('tricks/trick.html.twig', ['trick' => $trick]);
    }

    #[Route ('/trick/edit/{id}', name:'edit_trick', methods: ['GET', 'POST'])]
    public function editTrick(string $id, TrickRepository $trickRepository): Response   
    {
        $trick = $trickRepository->find($id);
        return $this->render('tricks/editTrick.html.twig', ['trick' => $trick]);

    }

    #[Route ('/new-trick', name:'new_trick', methods: ['GET', 'POST'])]
    public function newTrick(): Response 
    {
        return $this->render('tricks/newTrick.html.twig');
    }
}