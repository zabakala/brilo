<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Service\PaginatorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostsPageController extends PostsController
{
    #[Route('/posts/page/{page}', name: 'app_posts_page')]
    public function index(
        EntityManagerInterface $entityManager,
        PaginatorService $paginatorService,
        PostRepository $postRepository,
        Request $request,
    ): Response
    {
        $page = $request->attributes->getInt('page', 1);

        return $this->renderTemplate($entityManager, $paginatorService, $postRepository, $page);
    }
}
