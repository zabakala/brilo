<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Service\PaginatorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PostsController extends AbstractController
{
    protected function renderTemplate(
        EntityManagerInterface $entityManager,
        PaginatorService $paginatorService,
        PostRepository $postRepository,
        int $page,
    ): Response
    {
        $result = $postRepository->findAll();
        $paginator = $paginatorService->paginate($entityManager->getRepository($postRepository->getClassName()), $page);

        return $this->render(
            'posts/index.html.twig',
            [
                'posts' => $result,
                'paginator' => $paginator,
            ]
        );
    }
}
