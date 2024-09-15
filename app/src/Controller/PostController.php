<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    #[Route('/post/{seo}', name: 'app_post')]
    public function index(
        CommentRepository $commentRepository,
        PostRepository $postRepository,
        Request $request,
    ): Response
    {

        $seo = $request->attributes->get('seo');
        $post = $postRepository->findOneBy(['seoTitle' => $seo]);
        $comments = $commentRepository->findBy(['post' => $post->getId()]);

        return $this->render(
            'post/index.html.twig',
            [
                'post' => $post,
                'author' => $post->getUser(),
                'comments' => $comments,
            ]
        );
    }
}
