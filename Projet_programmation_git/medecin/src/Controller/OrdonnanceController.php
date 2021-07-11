<?php

namespace App\Controller;

use App\Entity\Ordonnance;
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
     * @Route("/", name="ordonnance_index", methods={"GET","POST"})
     */
    public function index(OrdonnanceRepository $ordonnanceRepository,Request $request, PersonnelRepository $repos, MaterniteRepository $mat, 
    UrgenceRepository $urg,PatientRepository $p, InternationalRepository $inter): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $personnel = $repos->findByEmail($this->getUser()->getEmail());
        $maternite = $mat->findByEmail($this->getUser()->getEmail());
        $urgence = $urg->findByEmail($this->getUser()->getEmail());
       // $internationnal = $inter->findByEmail($this->getUser()->getEmail());
        $patient = $p->findByEmail($this->getUser()->getEmail());
        if($personnel){
            $value=$personnel;
        }else if($maternite){
            $value=$maternite;
        }else if($urgence){
            $value=$urgence;
        }else if($patient){
            $value=$patient;
        }
        $request = $request->getContent();
        $pat = json_decode($request, true);
        $ordon = $ordonnanceRepository->findBy(['idPersonnel'=>$value]);
        return $this->json($ordon, 200, [], $defaultContext);
    }

    /**
     * @Route("/new", name="ordonnance_new", methods={"GET","POST"})
     */
    public function new(Request $request, PersonnelRepository $repos,MaterniteRepository $mat, UrgenceRepository $urg,PatientRepository $p, InternationalRepository $inter): Response
    {
        $ordonnance = new Ordonnance();
       $request = $request->getContent();
       $pat = json_decode($request, true);
       $personnel = $repos->findOneByEmail($this->getUser()->getEmail());
       $value = $pat['patient'];
       $urgence = $urg->findOneById($value);
       $patien = $p->findOneById($value);
       $internationnal = $inter->findOneById($value);
       $maternite = $mat->findOneById($value);
       $ordonnance->setContenu($pat['content']);
       $ordonnance->setIdPersonnel($personnel);
       if($pat['service']=="Maternite")
       {
            $ordonnance->setIdMaternite($maternite);
       }elseif($pat['service']=="Urgence")
       {
            $ordonnance->setIdUrgence($urgence);
       }elseif($pat['service']=="Patient")
       {
            $ordonnance->setIdPatient($patien);
       }elseif($pat['service']=="international")
       {
            $ordonnance->setIdInternational($internationnal);
       }
       $om=$this->getDoctrine()->getManager();
       $om->persist($ordonnance);
       $om->flush();
       
        return $this->json("ok");
    }

    /**
     * @Route("/{id}", name="ordonnance_show", methods={"GET"})
     */
    public function show(Ordonnance $ordonnance): Response
    {
        return $this->render('ordonnance/show.html.twig', [
            'ordonnance' => $ordonnance,
        ]);
    }

    /**
     * @Route("/modif/edit/{id}", name="ordonnance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ordonnance $ordonnance): Response
    {
        $form = $this->createForm(OrdonnanceType::class, $ordonnance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ordonnance_index');
        }

        return $this->render('ordonnance/edit.html.twig', [
            'ordonnance' => $ordonnance,
            'form' => $form->createView(),
        ]);
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
