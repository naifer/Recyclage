<?php

namespace App\Controller;

use App\Entity\Forum;
use App\Form\ForumType;
use App\Entity\Comment;
use App\Form\CommentType;

use App\Repository\ForumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/forum")
 */
class ForumController extends AbstractController
{

    /**
     * @Route("/", name="forum_index", methods={"GET"})
     */
    public function index(ForumRepository $forumRepository): Response
    {
        return $this->render('forum/index.html.twig', [
            'forums' => $forumRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="forum_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $forum = new Forum();
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($forum);
            $entityManager->flush();

            return $this->redirectToRoute('forum_index');
        }

        return $this->render('forum/new.html.twig', [
            'forum' => $forum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_show", methods={"GET","POST"})
     */
     public function show(Forum $forum , Comment $comment ,Request $request ): Response
     {


       $form = $this->createForm(CommentType::class, $comment);
       $form->handleRequest($request);

       $comments = $this->getDoctrine()
           ->getRepository(Comment::class)
           ->findByForum($comment->getForum());

           if ($form->isSubmitted() && $form->isValid()) {
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($comment);
               $entityManager->flush(); //save

               return $this->render('forum/show.html.twig', [
                   'forum' => $forum, 'comments'=> $comments,'form' => $form->createView()
               ]);

           }


       return $this->render('forum/show.html.twig', [
           'forum' => $forum, 'comments'=> $comments,'form' => $form->createView()
       ]);
     }

    /**
     * @Route("/{id}/edit", name="forum_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Forum $forum): Response
    {
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forum_index');
        }

        return $this->render('forum/edit.html.twig', [
            'forum' => $forum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Forum $forum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($forum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('forum_index');
    }

    /**
     * @Route("/like", name="forum_like", methods={"post"})
     */
    public function LikepostAction(Request $request,ForumRepository $forumRepository) : JsonResponse
    {
        $postss=$request->request->get('post');
        $posts = $forumRepository->find($postss);

        $posts->setNblike($posts->getNblike()+1);

        $m=$this->getDoctrine()->getManager();
        $m->persist($posts);
        $m->flush();
        return new JsonResponse();


    }
}
