<?php

namespace App\Controller;

use App\Entity\Suivi;
use App\Form\SuiviType;
use App\Repository\SuiviRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/suivi")
 */
class SuiviController extends AbstractController
{
    /**
     * @Route("/", name="suivi_index", methods={"GET"})
     */
    public function index(SuiviRepository $suiviRepository): Response
    {
        return $this->render('suivi/index.html.twig', [
            'suivis' => $suiviRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="suivi_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $suivi = new Suivi();
        $form = $this->createForm(SuiviType::class, $suivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($suivi);
            $entityManager->flush();

            return $this->redirectToRoute('suivi_index');
        }

        return $this->render('suivi/new.html.twig', [
            'suivi' => $suivi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="suivi_show", methods={"GET"})
     */
    public function show(Suivi $suivi): Response
    {
        return $this->render('suivi/show.html.twig', [
            'suivi' => $suivi,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="suivi_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Suivi $suivi): Response
    {
        $form = $this->createForm(SuiviType::class, $suivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('suivi_index');
        }

        return $this->render('suivi/edit.html.twig', [
            'suivi' => $suivi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="suivi_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Suivi $suivi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$suivi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($suivi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('suivi_index');
    }
}
