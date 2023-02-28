<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{
    #[Route('/post/{id}', name: 'app_post')]
    public function index(EntityManagerInterface $entityManager, int $id): Response
    {
        $post = $entityManager->getRepository(Post::class)->findBy(['id' => $id], []);

        //On met le $post[0] à null, comme ça le twig peut handle l'erreur
        if(!$post[0]) {
            $post = [null];
        }

        $commentForm = $this->createForm(CommentType::class);

        return $this->render('post/index.html.twig', [
            'post' => $post[0],
            'user' => $this->getUser(),
            'commentForm' => $commentForm->createView()
        ]);
    }


    #[Route("/post/{id}/comment/add", name: "add_comment")]
    public function addComment(Request $request, EntityManagerInterface $entityManager, Post $post): Response
    {
        $comment = new Comment();
        $comment->setUser($this->getUser());
        $comment->setPost($post);

        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $entityManager->persist($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post', [
            'id' => $post->getId()
        ]);
    }

    #[Route('/posts', name: 'app_posts')]
    public function indexArticle(EntityManagerInterface $entityManager): Response
    {
        $posts = $entityManager->getRepository(Post::class)->findAll();

        return $this->render('post/indexAll.html.twig', [
            'posts' => $posts,
            'user' => $this->getUser()
        ]);
    }
}
