<?php

namespace App\Controller;

use App\Entity\Cotegory;
use App\Form\CotegoryType;
use App\Repository\CotegoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cotegory")
 */
class CotegoryController extends AbstractController
{
    /**
     * @Route("/", name="cotegory_index", methods={"GET"})
     */
    public function index(CotegoryRepository $cotegoryRepository): Response
    {
        return $this->render('cotegory/index.html.twig', [
            'cotegories' => $cotegoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cotegory_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cotegory = new Cotegory();
        $form = $this->createForm(CotegoryType::class, $cotegory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cotegory);
            $entityManager->flush();

            return $this->redirectToRoute('cotegory_index');
        }

        return $this->render('cotegory/new.html.twig', [
            'cotegory' => $cotegory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cotegory_show", methods={"GET"})
     */
    public function show(Cotegory $cotegory): Response
    {
        return $this->render('cotegory/show.html.twig', [
            'cotegory' => $cotegory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cotegory_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cotegory $cotegory): Response
    {
        $form = $this->createForm(CotegoryType::class, $cotegory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cotegory_index');
        }

        return $this->render('cotegory/edit.html.twig', [
            'cotegory' => $cotegory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cotegory_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cotegory $cotegory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cotegory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cotegory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cotegory_index');
    }
}
