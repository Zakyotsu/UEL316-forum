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
        $posts = $postsRepository->findBy([], ['date' => 'DESC'], 3);
        return $this->render('home_page/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    public function homePostList($page, Application $app) {
        $posts = $app['dao.link']->findLinksByRange(3, $page);
        $nextPosts = $app['dao.link']->findLinksByRange(3, $page+1);
        return $app['twig']->render('news/index.html.twig', array(
            'posts' => $posts,
            'page'  => $page,
            'nbElementsNext' => count($nextPosts)
        ));
    }

}
