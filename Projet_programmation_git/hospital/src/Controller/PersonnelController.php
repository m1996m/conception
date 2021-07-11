<?php

namespace App\Controller;

use App\Entity\Personnel;
use App\Form\PersonnelType;
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
 * @Route("api/personnel")
 */
class PersonnelController extends AbstractController
{
    private $passwordEncoder;
    private $entityManager;
    public function __construct (UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $ent)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $ent;
    }
    /**
     * @Route("/", name="personnel_index", methods={"GET"})
     */
    public function index(PersonnelRepository $personnelRepository): Response
    {
        $personnel = $personnelRepository->findAll();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
       // $personnel =  $serializer->serialize($personnel, 'json');
        return $this->json($personnel, 200, [], $defaultContext);
    }

    /**
     * @Route("/new", name="personnel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $personnel = new Personnel();
        $request = $request->getContent();
        $perso=json_decode($request,true);
        $personnel->setNom($perso['nom']);
        $personnel->setPrenom($perso['prenom']);
        $personnel->setDateNaissance(Carbon::parse($perso['dateNaissance']));
        $personnel->setAdresse($perso['adresse']);
        $personnel->setImage($perso['image']);
        $personnel->setGenre($perso['genre']);
        $personnel->setUser($this->getUser());
        $personnel->setTelephone($perso['telephone']);
        $personnel->setProfession($perso['profession']);
        $personnel->setFonction($perso['fonction']);
        $personnel->setSpecialite($perso['specialite']);
        $om=$this->getDoctrine()->getManager();
        $om->persist($personnel);
        $om->flush();

        return $this->json('ok');
    }

    /**
     * @Route("/personnel/{id}", name="personnel_show", methods={"GET"})
     */
    public function show(Personnel $personnel,PersonnelRepository $repos): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $pati = $repos->find($personnel);
        return $this->json($pati, 200, [], $defaultContext);
    }

   /**
     * @Route("/modif/edit/{id}", name="personnel_edit", methods={"GET","POST"})
    */
    public function edit(Request $request, Personnel $personnel): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $request = $request->getContent();
        $data = json_decode($request,true);
        $personnel->setNom($data['nom']);
        $personnel->setPrenom($data['prenom']);
        $personnel->setDateNaissance(Carbon::parse( $data['dateNaissance']));
        $personnel->setTelephone($data['telephone']);
        $personnel->setGenre($data['image']);
        $personnel->setGenre($data['genre']);
        $personnel->setProfession($data['profession']);
        $personnel->setFonction($data['adresse']);
        $personnel->setSpecialite($data['profession']);
        $personnel->setAdresse($data['adresse']);
        $om = $this->getDoctrine()->getManager();
        $om->flush();
        
        return $this->json($personnel,200, [], $defaultContext);
    }

    /**
     * @Route("/{id}", name="personnel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Personnel $personnel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personnel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personnel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personnel_index');
    }
}
