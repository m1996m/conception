<?php

namespace App\Controller;

use App\Entity\Personnel;
use App\Form\PersonnelType;
use App\Repository\PersonnelRepository;
use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/personnel")
 */
class PersonnelController extends AbstractController
{
    /**
     * @Route("/", name="personnel_index", methods={"GET"})
     */
    public function index(PersonnelRepository $personnelRepository): Response
    {
        $personnelRepository->findAll();
        return $this->json($personnelRepository->findAll());
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
        $personnel->setEmail($perso['email']);
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
        $pati = $repos->find($personnel);
        return $this->json($pati);
    }
    

    /**
     * @Route("/modif/edit/{id}", name="personnel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Personnel $personnel): Response
    {
        $request = $request->getContent();
        $data = json_decode($request,true);
        $personnel->setNom($data['nom']);
        $personnel->setPrenom($data['prenom']);
        $personnel->setDateNaissance(Carbon::parse( $data['dateNaissance']));
        $personnel->setTelephone($data['telephone']);
        $personnel->setEmail($data['email']);
        $personnel->setProfession($data['profession']);
        $personnel->setFonction($data['adresse']);
        $personnel->setSpecialite($data['profession']);
        $personnel->setAdresse($data['adresse']);
        $om = $this->getDoctrine()->getManager();
        $om->flush();
        
        return $this->json($personnel);
    }

    /**
     * @Route("/supp/delete/{id}", name="personnel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Personnel $personnel): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($personnel);
        $entityManager->flush();

        return $this->json('Ok');
    }
}
