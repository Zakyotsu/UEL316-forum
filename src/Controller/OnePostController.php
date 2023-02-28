<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CommentType;
use App\Form\ReportType;
use App\Repository\PostsRepository;
use App\Entity\Reports;
use App\Entity\User;
use App\Entity\Posts;
use App\Entity\Comments;

 

class OnePostController extends AbstractController 

{ 

    #[Route('/onepost/{id}', name: 'app_one_post')] 

    public function show(int $id, PostsRepository $postsRepository): Response 

    { 
		$commentForm = $this->createForm(CommentType::class);
        if (!$postsRepository) {
        $postsRepository = $this->getDoctrine()->getRepository(Posts::class);
    }
    $post = $postsRepository->find($id);
        if (!$post) { 
            throw $this->createNotFoundException('Post not found'); 
        } 
        return $this->render('onepost/index.html.twig', [ 
            'post' => $post,
        'commentForm' => $commentForm->createView(),
        ]); 
    } 


 #[Route("/post/{id}/comment/add", name: "add_comment")]
public function addComment(Request $request, EntityManagerInterface $entityManager, Posts $post): Response
{
     $comment = new Comments();
    $comment->setUser($this->getUser());
    $comment->setPost($post);

    $commentForm = $this->createForm(CommentType::class, $comment);
    $commentForm->handleRequest($request);

    if ($commentForm->isSubmitted() && $commentForm->isValid()) {
        $entityManager->persist($comment);
        $entityManager->flush();

        $post = $entityManager->getRepository(Posts::class)->find($post->getId());

        return $this->render('onepost/index.html.twig', [
            'post' => $post,
            'commentForm' => $commentForm->createView(),
        ]);
    }

    return $this->show($post->getId(), $entityManager->getRepository(Posts::class));
}
 #[Route("/post/{id}/comment/report", name: "report_comment")]
   public function reportComment(Request $request, EntityManagerInterface $entityManager, Comments $comment, Posts $post): Response
    {
        $report = new Reports();
        $report->setComment($comment);
        $report->setUser($this->getUser());
  $post = $entityManager->getRepository(Posts::class)->find($post->getId());
        $reportForm = $this->createForm(ReportType::class, $report);
        $reportForm->handleRequest($request);

        if ($reportForm->isSubmitted() && $reportForm->isValid()) {
            $entityManager->persist($report);
            $entityManager->flush();

            $this->addFlash('success', 'Your report was submitted successfully!');

            return $this->redirectToRoute('onepost/', ['id' => $comment->getPost()->getId()]);
        }

       return $this->show($post->getId(), $entityManager->getRepository(Posts::class));
    }

} 