<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TrickController extends AbstractController
{
    #[Route('/trick/{id}', name: 'show_trick', methods: ['GET', 'POST'])]
    public function showTrick(string $id, TrickRepository $trickRepository, CommentRepository $commentRepository): Response
    {
        $trick = $trickRepository->find($id);
        $comment = $commentRepository->findCommentByTrick($id, page: 1);
        return $this->render('tricks/trick.html.twig', [
            'trick' => $trick,
            'comment' => $comment
        ]);
    }

    #[Route('/trick/{id}/comments', name: 'load-more-comments', methods: ['GET'])]
    public function loadMoreComments(Request $request, CommentRepository $commentRepository, string $id): JsonResponse {
        $page = $request->query->has('page') ? $request->query->getInt('page') : 2;
        $comment = $commentRepository->findCommentByTrick($id, $page);
        return new JsonResponse(
            [
                'code' => 200,
                'html' => $this->renderView('parts/_comments.html.twig', ['comment' => $comment])
            ]
        );
    }

    #[Route ('/trick/edit/{id}', name:'edit_trick', methods: ['GET', 'POST'])]
    public function editTrick(Request $request, string $id, TrickRepository $trickRepository): Response   
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