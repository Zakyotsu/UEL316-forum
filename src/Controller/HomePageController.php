<?php

namespace App\Controller;

use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(PostsRepository $postsRepository): Response
    {
        $posts = $postsRepository->findBy([], ['date' => 'ASC'], 3);
        return $this->render('home_page/index.html.twig', [
            'posts' => $posts,
            'user' => $this->getUser()
        ]);
    }
}
