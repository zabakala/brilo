<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Service\PaginatorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostsHomeController extends PostsController
{
    #[Route('/', name: 'app_posts')]
    public function index(
        EntityManagerInterface $entityManager,
        PaginatorService $paginatorService,
        PostRepository $postRepository,
        Request $request,
    ): Response
    {
        $page = $request->query->getInt('page', 1);

        return $this->renderTemplate($entityManager, $paginatorService, $postRepository, $page);
    }
}
