<?php

namespace App\Controller;

use App\Entity\Maternite;
use App\Entity\Personnel;
use App\Form\MaterniteType;
use App\Repository\MaterniteRepository;
use App\Repository\PersonnelRepository;
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
        $maternites=$materniteRepository->findBy(['personnel'=> $this->getUser()->getPersonnel()]);
        return $this->json($maternites, 200, [], $defaultContext);
    }

    /**
     * @Route("/new", name="maternite_new", methods={"GET","POST"})
     */
    public function new(Request $request, PersonnelRepository $perso): Response
    {
        $maternite = new Maternite();
        $request = $request->getContent();
        $mat = json_decode($request,true);
        $personnel=$perso->findOneById($mat['personnel']);
        $maternite->setPatient($this->getUser()->getPatient());
        $maternite->setDebut(Carbon::parse($mat['debut']));
        $maternite->setAccouchement(Carbon::parse($mat['accouchement']));
        $maternite->setDescription($mat['description']);
        $maternite->setPersonnel($personnel);
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
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $maternite = new Maternite();
        $request = $request->getContent();
        $mat = json_decode($request,true);
        $maternite->setDebut(Carbon::parse($mat['debut']));
        $maternite->setAccouchement(Carbon::parse($mat['accouchement']));
        $maternite->setDescription($mat['description']);
        $om=$this->getDoctrine()->getManager();
        $om->flush();
        return $this->json($maternite,200, [], $defaultContext);
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
