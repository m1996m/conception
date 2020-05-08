<?php

namespace App\Controller;

use App\Entity\Ordonnance;
use App\Entity\Produit;
use App\Form\OrdonnanceType;
use App\Repository\InternationalRepository;
use App\Repository\MaterniteRepository;
use App\Repository\OrdonnanceRepository;
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
 * @Route("api/ordonnance")
 */
class OrdonnanceController extends AbstractController
{
    private $passwordEncoder;
    private $entityManager;
    public function __construct (UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $ent)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $ent;
    }
    /**
     * @Route("/", name="ordonnance_index1", methods={"GET"})
     */
    public function index(OrdonnanceRepository $ordonnanceRepository): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];

        $ordon = $ordonnanceRepository->findAll();
        //$ordon = $ordonnanceRepository->find($this->getUser()->getPatient());
        return $this->json($ordon, 200, [], $defaultContext);
    }

      /**
     * @Route("/ordonnace/cherche", name="ordonnance_pattient", methods={"GET"})
     */
    public function sechOrdonnance(OrdonnanceRepository $ordonnanceRepository): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];

        $ordon = $ordonnanceRepository->findBy(['patient'=>$this->getUser()->getPatient()]);
        return $this->json($ordon, 200, [], $defaultContext);
    }

    /**
     * @Route("/new", name="ordonnance_new", methods={"POST"})
     */
    public function new(Request $request, PatientRepository $repos, PersonnelRepository $rep): Response
    {
        $request = $request->getContent();
        $ordonnance = new Ordonnance();
        $pat = json_decode($request, true);
        $patient=$repos->findOneById($pat['patient']);
        $personnel=$rep->findOneById($this->getUser()->getPersonnel());
        //$ordonnance->setContent($pat['content']);
       $ordonnance->setPersonnel($personnel);
       $ordonnance->setPatient($patient);
       $ordonnance->setCreatedAt(new \DateTime());
       $om=$this->getDoctrine()->getManager();
       $om->persist($ordonnance);
       $om->flush();
       $contents = $pat['content'];


       $manager=$this->getDoctrine()->getManager();

       foreach($contents as $content){
            $produit = new Produit();
            $produit->setDesignation($content);
            $produit->setOrdonnance($ordonnance);
            $manager->persist($produit);
       }
       $manager->flush();
       return $this->json('ok');
    }

    /**
     * @Route("/ordonnance/{id}", name="urgence_show", methods={"GET"})
     */
    public function show(Ordonnance $ordonnance, OrdonnanceRepository $repos): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $ordonnances=$repos->find($ordonnance);
        return $this->json($ordonnances, 200, [], $defaultContext);
    }
    /**
     * @Route("/modif/edit/{id}", name="ordonnance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ordonnance $ordonnance): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $ordonnance = new Ordonnance();
        $request = $request->getContent();
        $pat = json_decode($request, true);
        $value = $pat['patient'];
        $ordonnance->setPatient($pat['patient']);
        $om=$this->getDoctrine()->getManager();
        $om->flush();
        return $this->json($ordonnance, 200, [], $defaultContext);
    }

    /**
     * @Route("/supp/delete/{id}", name="ordonnance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ordonnance $ordonnance): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($ordonnance);
        $entityManager->flush();
        return $this->json('suppression reussie');
    }
}
