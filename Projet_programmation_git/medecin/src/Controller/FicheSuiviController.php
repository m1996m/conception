<?php

namespace App\Controller;

use App\Entity\FicheSuivi;
use App\Form\FicheSuiviType;
use App\Repository\FicheSuiviRepository;
use App\Repository\PersonnelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * @Route("/fiche/suivi")
 */
class FicheSuiviController extends AbstractController
{
    /**
     * @Route("/", name="fiche_suivi_index", methods={"GET"})
     */
    public function index( $ficheSuiviRepository,Request $request, PersonnelRepository $repos): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $personnel = $repos->findOneByEmail($this->getUser()->getEmail());
        $request = $request->getContent();
        $pa = json_decode($request, true);
        $query = $this->entityManager->createQuery(
            'SELECT p
            FROM App\Entity\FichePatient p
            WHERE p.service = :service
            ORDER BY p.service ASC'
        )->setParameters('service', $pa['service']);
        //$pati = $fichePatientRepository->findOneByIdPersonnel($personnel);
        return $this->json($query->getResult(), 200, [], $defaultContext);
    }

    /**
     * @Route("/new", name="fiche_suivi_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ficheSuivi = new FicheSuivi();
        $form = $this->createForm(FicheSuiviType::class, $ficheSuivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ficheSuivi);
            $entityManager->flush();

            return $this->redirectToRoute('fiche_suivi_index');
        }

        return $this->render('fiche_suivi/new.html.twig', [
            'fiche_suivi' => $ficheSuivi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fiche_suivi_show", methods={"GET"})
     */
    public function show(FicheSuivi $ficheSuivi): Response
    {
        return $this->render('fiche_suivi/show.html.twig', [
            'fiche_suivi' => $ficheSuivi,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fiche_suivi_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FicheSuivi $ficheSuivi): Response
    {
        $form = $this->createForm(FicheSuiviType::class, $ficheSuivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fiche_suivi_index');
        }

        return $this->render('fiche_suivi/edit.html.twig', [
            'fiche_suivi' => $ficheSuivi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fiche_suivi_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FicheSuivi $ficheSuivi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficheSuivi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ficheSuivi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fiche_suivi_index');
    }
}
