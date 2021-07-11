<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\PatientType;
use App\Repository\PatientRepository;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * @Route("api/patient")
 */
class PatientController extends AbstractController
{
    private $passwordEncoder;
    private $entityManager;
    public function __construct (UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $ent)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $ent;
    }
    /**
     * @Route("/", name="patient_index", methods={"GET"})
     */
    public function index(PatientRepository $patientRepository): Response
    {
        $patients = $patientRepository->findAll();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
       // $patients =  $serializer->serialize($patients, 'json');
        return $this->json($patients, 200, [], $defaultContext);
    }

    /**
     * @Route("/new", name="patient_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $request = $request->getContent();
       $patient = new Patient();
       $pat = json_decode($request, true);
       $patient->setNom($pat['nom']);
       $patient->setUser($this->getUser());
       $patient->setPrenom($pat['prenom']);
       $patient->setDateNaissance(Carbon::parse($pat['dateNaissance']));
       $patient->setAdresse($pat['adresse']);
       $patient->setImage($pat['image']);
       $patient->setGenre($pat['genre']);
       $patient->setTelephone($pat['telephone']);
       $patient->setProfession($pat['profession']);
       $om=$this->getDoctrine()->getManager();
       $om->persist($patient);
       $om->flush();
       
        return $this->json("ok");
    }

    /**
     * @Route("/patient/{id}", name="patient_show", methods={"GET"})
     */
    public function show(Patient $patient,PatientRepository $repos): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $pati = $repos->find($patient);
        return $this->json($pati, 200, [], $defaultContext);
    }  

    /**
     * @Route("/modif/edit/{id}", name="patient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Patient $patient): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $request = $request->getContent();
        $data = json_decode($request,true);
        $patient->setNom($data['nom']);
        $patient->setPrenom($data['prenom']);
        $patient->setDateNaissance(Carbon::parse( $data['dateNaissance']));
        $patient->setTelephone($data['telephone']);
        $patient->setImage($data['image']);
        $patient->setGenre($data['genre']);
        $patient->setProfession($data['profession']);
        $patient->setAdresse($data['adresse']);
        $om = $this->getDoctrine()->getManager();
        $om->flush();
        
        return $this->json($patient, 200, [], $defaultContext);
    }

   /**
     * @Route("/supp/delete/{id}", name="patient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Patient $patient): Response
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($patient);
        $entityManager->flush();

        return $this->json('ok');
    }
}
