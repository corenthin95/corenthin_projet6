<?php

namespace App\Controller;

use App\Form\TrickType;
use App\Form\CommentType;
use App\Entity\Comment;
use App\Repository\TrickRepository;
use App\Repository\CommentRepository;
use App\Service\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class TrickController extends AbstractController
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private EntityManagerInterface $entityManager,
        private SluggerInterface $slugger
    ) {        
        $this->slugger = $slugger;
    }

    #[Route('/trick/{slug}', name: 'show_trick', methods: ['GET', 'POST'])]
    public function showTrick(Request $request, string $slug, TrickRepository $trickRepository, CommentRepository $commentRepository): Response
    {
        $trick = $trickRepository->findOneBy(['slug' => $slug]);
        $comment = $commentRepository->findCommentByTrick($trick->getId(), 1);
        $totalComments = $trick->getComment()->count();
        $medias = array_merge($trick->getImage()->toArray(), $trick->getVideo()->toArray());

        $form = $this->formFactory->create(CommentType::class)
                                  ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setUser($this->getUser());
            $comment->setTrick($trick);

            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('tricks/trick.html.twig', [
            'trick' => $trick,
            'comment' => $comment,
            'totalComments' => $totalComments,
            'form' => $form->createView(),
            'medias' => $medias,
        ]);
    }

    #[Route('/trick/{slug}/comments', name: 'load-more-comments', methods: ['GET'])]
    public function loadMoreComments(Request $request, TrickRepository $trickRepository, CommentRepository $commentRepository, string $slug): JsonResponse {
        $page = $request->query->has('page') ? $request->query->getInt('page') : 2;
        $trick = $trickRepository->findOneBy(['slug' => $slug]);
        $comment = $commentRepository->findCommentByTrick($trick->getId(), $page);
        return new JsonResponse(
            [
                'code' => 200,
                'html' => $this->renderView('parts/_comments.html.twig', ['comment' => $comment])
            ]
        );
    }

    #[Route ('/trick/edit/{slug}', name:'edit_trick', methods: ['GET', 'POST'])]
    public function editTrick(string $slug, TrickRepository $trickRepository): Response   
    {
        $trick = $trickRepository->findOneBy(['slug' => $slug]);
        return $this->render('tricks/editTrick.html.twig', ['trick' => $trick]);

    }

    #[Route ('/new-trick', name:'new_trick', methods: ['GET', 'POST'])]
    public function newTrick(Request $request, UploadFileService $uploadFileService): Response 
    {
        $form = $this->formFactory->create(TrickType::class)
                                  ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick = $form->getData();
            $trick->setSlug(strtolower($this->slugger->slug($trick->getName())));
            $trick->setUser($this->getUser());
            $trickMainImage = $trick->getMainImage();

            if($trickMainImage) {
                $mainImage = $uploadFileService->upload($trickMainImage);
                $trick->setMainImage($mainImage);
            }

            foreach ($trick->getImage() as $image) {
                $imageFilename = $uploadFileService->upload($image->getFile());
                $image->setFilename($imageFilename);
                $trick->addImage($image);
            }

            $this->entityManager->persist($trick);
            $this->entityManager->flush();

            return $this->redirectToRoute('show_trick', ['slug' => $trick->getSlug()]);
        }

        return $this->render(
            'tricks/newTrick.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    #[Route ('/delete/{id}', name: 'delete_trick', methods: ['GET', 'DELETE'])]
    public function deleteTrick(string $id, TrickRepository $trickRepository)
    {
        $trick = $trickRepository->find($id);

        foreach ($trick->getComment() as $comment) {
            $this->entityManager->remove($comment);
        }

        $this->entityManager->remove($trick);
        $this->entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}