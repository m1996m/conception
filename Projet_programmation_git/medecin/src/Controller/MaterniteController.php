<?php

namespace App\Controller;

use App\Entity\Maternite;
use App\Form\MaterniteType;
use App\Repository\MaterniteRepository;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * @Route("api/maternite")
 */
class MaterniteController extends AbstractController
{
    private $passwordEncoder;
    private $entityManager;
    public function __construct (UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $ent)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $ent;
    }
    /**
     * @Route("/", name="maternite_index", methods={"GET"})
     */
    public function index(MaterniteRepository $materniteRepository): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $maternites=$materniteRepository->findAll();
        return $this->json($maternites, 200, [], $defaultContext);
    }

    /**
     * @Route("/maternite/recherche", name="maternite_recherche", methods={"GET","POST"})
     */
    public function rechercherMaternite(Request $request): Response
    {
        //$entityManager = $this->getDoctrine()->getRepository(Patient::class);
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $patient = new Maternite();
        $request = $request->getContent();
        $pa = json_decode($request, true);
        $query = $this->entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Maternite p
            WHERE p.telephone = :telephone
            ORDER BY p.telephone ASC'
        )->setParameter('telephone', $pa['telephone']);

        // returns an array of Product objects
        return $this->json($query->getOneOrNullResult(), 200, [], $defaultContext);
    }

    /**
     * @Route("/new", name="maternite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $maternite = new Maternite();
        $request = $request->getContent();
        $mat = json_decode($request,true);
        $maternite->setNom($mat['nom']);
        $maternite->setPrenom($mat['prenom']);
        $maternite->setDateNaissance(Carbon::parse($mat['dateNaissance']));
        $maternite->setAdresse($mat['adresse']);
        $maternite->setEmail($mat['email']);
        $maternite->setTelephone($mat['telephone']);
        $maternite->setProfession($mat['profession']);
        $maternite->setDebutGrossesse(Carbon::parse($mat['debutGrossesse']));
        $maternite->setAccouchementPrevu(Carbon::parse($mat['accouchementPrevu']));
        $maternite->setDescription($mat['description']);
        $om=$this->getDoctrine()->getManager();
        $om->persist($maternite);
        $om->flush();
        return $this->json('ok');
    }

    /**
     * @Route("/maternite/{id}", name="maternite_show", methods={"GET"})
     */
    public function show(Maternite $maternite, MaterniteRepository $repos): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $mat = $repos->find($maternite);
        return $this->json($mat, 200, [], $defaultContext);
    }

    /**
     * @Route("/modif/edit/{id}", name="maternite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Maternite $maternite): Response
    {
        $maternite = new Maternite();
        $request = $request->getContent();
        $mat = json_decode($request,true);
        $maternite->setNom($mat['nom']);
        $maternite->setPrenom($mat['prenom']);
        $maternite->setDateNaissance(Carbon::parse($mat['dateNaissance']));
        $maternite->setAdresse($mat['adresse']);
        $maternite->setEmail($mat['email']);
        $maternite->setTelephone($mat['telephone']);
        $maternite->setProfession($mat['profession']);
        $maternite->setDebutGrossesse(Carbon::parse($mat['debutGrossesse']));
        $maternite->setAccouchementPrevu(Carbon::parse($mat['accouchementPrevu']));
        $maternite->setDescription($mat['description']);
        $om=$this->getDoctrine()->getManager();
        $om->flush();
        return $this->json('ok');
    }

    /**
     * @Route("/supp/delete/{id}", name="maternite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Maternite $maternite): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($maternite);
        $entityManager->flush();
        return $this->json('ok');
    }
}
