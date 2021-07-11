<?php

namespace App\Controller;

use App\Entity\FichePatient;
use App\Form\FichePatientType;
use App\Repository\FichePatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fiche/patient")
 */
class FichePatientController extends AbstractController
{
    /**
     * @Route("/", name="fiche_patient_index", methods={"GET"})
     */
    public function index(FichePatientRepository $fichePatientRepository): Response
    {
        return $this->render('fiche_patient/index.html.twig', [
            'fiche_patients' => $fichePatientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="fiche_patient_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fichePatient = new FichePatient();
        $form = $this->createForm(FichePatientType::class, $fichePatient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fichePatient);
            $entityManager->flush();

            return $this->redirectToRoute('fiche_patient_index');
        }

        return $this->render('fiche_patient/new.html.twig', [
            'fiche_patient' => $fichePatient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fiche_patient_show", methods={"GET"})
     */
    public function show(FichePatient $fichePatient): Response
    {
        return $this->render('fiche_patient/show.html.twig', [
            'fiche_patient' => $fichePatient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fiche_patient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FichePatient $fichePatient): Response
    {
        $form = $this->createForm(FichePatientType::class, $fichePatient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fiche_patient_index');
        }

        return $this->render('fiche_patient/edit.html.twig', [
            'fiche_patient' => $fichePatient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fiche_patient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FichePatient $fichePatient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fichePatient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fichePatient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fiche_patient_index');
    }
}
