<?php

namespace App\Controller;

use App\Entity\Urgence;
use App\Form\UrgenceType;
use App\Repository\UrgenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/urgence")
 */
class UrgenceController extends AbstractController
{
    /**
     * @Route("/", name="urgence_index", methods={"GET"})
     */
    public function index(UrgenceRepository $urgenceRepository): Response
    {
        return $this->render('urgence/index.html.twig', [
            'urgences' => $urgenceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="urgence_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $urgence = new Urgence();
        $form = $this->createForm(UrgenceType::class, $urgence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($urgence);
            $entityManager->flush();

            return $this->redirectToRoute('urgence_index');
        }

        return $this->render('urgence/new.html.twig', [
            'urgence' => $urgence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="urgence_show", methods={"GET"})
     */
    public function show(Urgence $urgence): Response
    {
        return $this->render('urgence/show.html.twig', [
            'urgence' => $urgence,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="urgence_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Urgence $urgence): Response
    {
        $form = $this->createForm(UrgenceType::class, $urgence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('urgence_index');
        }

        return $this->render('urgence/edit.html.twig', [
            'urgence' => $urgence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="urgence_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Urgence $urgence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$urgence->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($urgence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('urgence_index');
    }
}
