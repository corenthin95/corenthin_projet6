<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage', methods: ['GET', 'POST'])]
    public function index(TrickRepository $trickRepository): Response
    {
        $tricks = $trickRepository->findAll();
        return $this->render('home.html.twig', ['tricks' => $tricks]);
    }

    #[Route('/', name: "load_more_tricks", methods: ['GET'])]
    public function loadMoreTricks(Request $request, string $id, TrickRepository $trickRepository): JsonResponse
    {
        $page = $request->query->has('page') ? $request->query->getInt('page') : 2;
        $tricks = $trickRepository->getMoreTricks($id, $page);
        return new JsonResponse(
            [
                'code' => 200,
                'html' => $this->renderView('parts/_listTricks.html.twig', ['tricks' => $tricks])
            ]
        );

    }
}