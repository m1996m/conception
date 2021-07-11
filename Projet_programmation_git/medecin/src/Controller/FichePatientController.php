<?php

namespace App\Controller;

use App\Entity\FichePatient;
use App\Form\FichePatientType;
use App\Repository\FichePatientRepository;
use App\Repository\InternationalRepository;
use App\Repository\MaterniteRepository;
use App\Repository\PatientRepository;
use App\Repository\PersonnelRepository;
use App\Repository\UrgenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * @Route("api/fiche/patient")
 */
class FichePatientController extends AbstractController
{
    private $passwordEncoder;
    private $entityManager;
    public function __construct (UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $ent)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $ent;
    }
    /**
     * @Route("/", name="fiche_patient_index",  methods={"GET","POST"})
     */
    public function index(FichePatientRepository $fichePatientRepository,Request $request, PersonnelRepository $repos): Response
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
     * @Route("/recherche/fiche", name="fiche_patient_recherche",  methods={"GET","POST"})
     */
    public function fichePatient(FichePatientRepository $fichePatientRepository,Request $request, PersonnelRepository $repos): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $personnel = $repos->findOneById($this->getUser());
        $request = $request->getContent();
        $pat = json_decode($request, true);
        $patients = $fichePatientRepository->findBy(['idPersonnel'=>$personnel]);
        return $this->json($patients, 200, [], $defaultContext);
    }

    /**
     * @Route("/new", name="fiche_patient_new", methods={"GET","POST"})
     */
    public function new(Request $request, PersonnelRepository $repos,MaterniteRepository $mat, UrgenceRepository $urg,PatientRepository $p, InternationalRepository $inter): Response
    {
       $request = $request->getContent();
       
       $pat = json_decode($request, true);
       $personnel = $repos->findOneByEmail($this->getUser()->getEmail());
       $value = $pat['patient'];
       $urgence = $urg->findOneById($value);
       $patien = $p->findOneById($value);
       $internationnal = $inter->findOneById($value);
       $maternite = $mat->findOneById($value);
       $patient = new FichePatient();
       $patient->setStatut($pat['statut']);
       $patient->setIdPersonnel($personnel);
       if($pat['service']=="Maternite")
       {
            $patient->setIdMaternite($maternite);
       }elseif($pat['service']=="Urgence")
       {
            $patient->setIdUrgence($urgence);
       }elseif($pat['service']=="Patient")
       {
            $patient->setIdPatient($patien);
       }elseif($pat['service']=="international")
       {
            $patient->setIdInternational($internationnal);
       }
       $om=$this->getDoctrine()->getManager();
       $om->persist($patient);
       $om->flush();
       
        return $this->json("ok");
    }

    /**
     * @Route("/fpatien/{id}", name="fiche_patient_show", methods={"GET"})
     */
    public function show(FichePatient $fichePatient, FichePatientRepository $repos): Response
    {
       // $patient= $repos->find($fichePatient);
        return $this->json('ok');
    }

    /**
     * @Route("/modif/edit/{id}", name="fiche_patient_edit", methods={"GET","POST"})
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
     * @Route("/supp/delete/{id}", name="fiche_patient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FichePatient $fichePatient): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($fichePatient);
        $entityManager->flush();

        return $this->json("suppression reussie");
    }
}
