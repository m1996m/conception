<?php

namespace App\Controller;

use App\Entity\Urgence;
use App\Form\UrgenceType;
use App\Repository\UrgenceRepository;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * @Route("api/urgence")
 */
class UrgenceController extends AbstractController
{
    private $passwordEncoder;
    private $entityManager;
    public function __construct (UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $ent)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $ent;
    }
    /**
     * @Route("/", name="urgence_index", methods={"GET"})
     */
    public function index(UrgenceRepository $urgenceRepository): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $urg = $urgenceRepository->findAll();
        return $this->json($urg, 200, [], $defaultContext);
    }
        /**
     * @Route("/urgence/recherche", name="urgence_recherche", methods={"GET","POST"})
     */
    public function rechecheUrgence(Request $request): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $request = $request->getContent();
        $pa = json_decode($request, true);
        $query = $this->entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Urgence p
            WHERE p.telephone = :telephone'
        )->setParameter('telephone', $pa['telephone']);

        // returns an array of Product objects
        return $this->json($query->getResult(), 200, [], $defaultContext);
    }

    /**
     * @Route("/new", name="urgence_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $urgence = new Urgence();
        $request =$request->getContent();
        $urg=json_decode($request,true);
        $urgence->setNom($urg['nom']);
        $urgence->setPrenom($urg['prenom']);
        $urgence->setDateNaissance(Carbon::now());
        $urgence->setSuivi($urg['suivi']);
        $urgence->setEmail($urg['email']);
        $urgence->setTelephone($urg['telephone']);
        $urgence->setProfession($urg['profession']);
        $urgence->setHeure(Carbon::parse($urg['heure']));
        $urgence->setFinancement($urg['financement']);
       $urgence->setDateArrive(Carbon::parse($urg['dateArrive']));
        $om=$this->getDoctrine()->getManager();
        $om->persist($urgence);
        $om->flush();
        return $this->render('ok');
    }

    /**
     * @Route("/urgence/{id}", name="urgence_show", methods={"GET"})
     */
    public function show(Urgence $urgence, UrgenceRepository $repos): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $urg=$repos->find($urgence);
        return $this->json($urg, 200, [], $defaultContext);
    }

    /**
     * @Route("/modif/edit/{id}", name="urgence_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Urgence $urgence): Response
    {
        $request =$request->getContent();
        $urg=json_decode($request,true);
        $urgence->setNom($urg['nom']);
        $urgence->setPrenom($urg['prenom']);
        $urgence->setDateNaissance(Carbon::parse($urg['dateNaissance']));
        $urgence->setSuivi($urg['suivi']);
        $urgence->setEmail($urg['email']);
        $urgence->setTelephone($urg['telephone']);
        $urgence->setProfession($urg['profession']);
        $urgence->setHeure(Carbon::parse($urg['heure']));
        $urgence->setFinancement($urg['financement']);
        $urgence->setDateArrive(Carbon::parse($urg['dateArrive']));
        $om=$this->getDoctrine()->getManager();
        $om->flush();
        return $this->json('ok');
    }

    /**
     * @Route("/supp/delete/{id}", name="urgence_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Urgence $urgence): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($urgence);
            $entityManager->flush();

        return $this->json('ok');
    }
}
