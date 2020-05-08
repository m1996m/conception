<?php

namespace App\Controller;

use App\Entity\FichePatient;
use App\Form\FichePatientType;
use App\Repository\FichePatientRepository;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * @Route("api/fiche/patient")
 */
class FichePatientController extends AbstractController
{
    /**
     * @Route("search/patient/personnel", name="patient_personnel_search", methods={"GET"})
     */
    public function fichePersonnel(FichePatientRepository $repos): Response
    {
        $fiche = $repos->findBy(['personnel'=>$this->getUser()->getPersonnel()]);
        //$patients = $patientRepository->findAll();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        return $this->json($fiche, 200, [], $defaultContext);
    }
    /**
     * @Route("/", name="fiche_patient_index", methods={"GET"})
     */
    public function index(FichePatientRepository $fichePatientRepository): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];

        $fiche = $fichePatientRepository->findBy(['personnel'=>$this->getUser()->getPersonnel()]);
        return $this->json($fiche, 200, [], $defaultContext);
    }

    /**
     * @Route("/new", name="fiche_patient_new", methods={"GET","POST"})
     */
    public function new(Request $request, PatientRepository $repos): Response
    {
        $fiche = new FichePatient();
        $request =$request->getContent();
        $urg=json_decode($request,true);
        $patient=$repos->findOneById($urg['patient']);
        $fiche->setPatient($patient);
        $fiche->setStatut($urg['statut']);
        $fiche->setCreatedAt(new \DateTime());
        $fiche->setPersonnel($this->getUser()->getPersonnel());
        $om=$this->getDoctrine()->getManager();
        $om->persist($fiche);
        $om->flush();
        return $this->json('ok');
    }

    /**
     * @Route("/fiche/patient/{id}", name="fiche_patient_show", methods={"GET"})
     */
    public function show(FichePatient $fichePatient, FichePatientRepository $repos): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $fiche=$repos->find($fichePatient);
        return $this->json($fiche, 200, [], $defaultContext);
    }

    /**
     * @Route("/modif/edit/{id}", name="fiche_patient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FichePatient $fichePatient, PatientRepository $repos): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $fiche = new FichePatient();
        $request =$request->getContent();
        $urg=json_decode($request,true);
        $patient=$repos->findOneById($urg['patient']);
        $fiche->setPatient($patient);
        $fiche->setStatut($urg['statut']);
        $fiche->setPersonnel($this->getUser()->getPersonnel());
        $om=$this->getDoctrine()->getManager();
        $om->flush();
        return $this->json($fiche, 200, [], $defaultContext);
    }

    /**
     * @Route("/supp/delete/{id}", name="fiche_patient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FichePatient $fichePatient): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($fichePatient);
        $entityManager->flush();
        return $this->json('Suppression reussie');
    }
}
