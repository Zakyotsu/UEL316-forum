<?php

namespace App\Controller;

use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'app_news')]
    public function index(PostsRepository $postsRepository): Response
    {
        $posts = $postsRepository->findAll();
        return $this->render('news/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
