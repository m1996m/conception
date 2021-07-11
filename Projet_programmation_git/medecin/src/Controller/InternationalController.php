<?php

namespace App\Controller;

use App\Entity\International;
use App\Form\InternationalType;
use App\Repository\InternationalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/international")
 */
class InternationalController extends AbstractController
{
    /**
     * @Route("/", name="international_index", methods={"GET"})
     */
    public function index(InternationalRepository $internationalRepository): Response
    {
        return $this->render('international/index.html.twig', [
            'internationals' => $internationalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="international_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $international = new International();
        $form = $this->createForm(InternationalType::class, $international);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($international);
            $entityManager->flush();

            return $this->redirectToRoute('international_index');
        }

        return $this->render('international/new.html.twig', [
            'international' => $international,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="international_show", methods={"GET"})
     */
    public function show(International $international): Response
    {
        return $this->render('international/show.html.twig', [
            'international' => $international,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="international_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, International $international): Response
    {
        $form = $this->createForm(InternationalType::class, $international);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('international_index');
        }

        return $this->render('international/edit.html.twig', [
            'international' => $international,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="international_delete", methods={"DELETE"})
     */
    public function delete(Request $request, International $international): Response
    {
        if ($this->isCsrfTokenValid('delete'.$international->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($international);
            $entityManager->flush();
        }

        return $this->redirectToRoute('international_index');
    }
}
