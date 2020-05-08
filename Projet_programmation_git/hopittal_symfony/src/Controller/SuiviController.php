<?php

namespace App\Controller;

use App\Entity\ContenuSuivi;
use App\Entity\Recommandation;
use App\Entity\Suivi;
use App\Form\SuiviType;
use App\Repository\PatientRepository;
use App\Repository\SuiviRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * @Route("api/suivi")
 */
class SuiviController extends AbstractController
{
    /**
     * @Route("/", name="suivi_index", methods={"GET"})
     */
    public function index(SuiviRepository $suiviRepository): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            }
        ];

        $suivi = $suiviRepository->findAll();
        return $this->json($suivi, 200, [], $defaultContext);
    }

    /**
     * @Route("/new", name="suivi_new", methods={"GET","POST"})
     */
    public function new(Request $request, PatientRepository $repos): Response
    {
        $fiche = new Suivi();
        $request =$request->getContent();
        $urg=json_decode($request,true);
        $patient=$repos->findOneById($urg['patient']);
        $fiche->setPatient($patient);
        $fiche->setCretedAt(new \DateTime());
        $fiche->setPersonnel($this->getUser()->getPersonnel());
        $om=$this->getDoctrine()->getManager();
        $om->persist($fiche);
        $om->flush();
        
        $contents = $urg['content'];
        $manager=$this->getDoctrine()->getManager();
        foreach($contents as $content){
             $contentuivi = new ContenuSuivi();
             $contentuivi->setContent($content);
             $contentuivi->setSuivi($fiche);
             $manager->persist($contentuivi);
        }
        $manager->flush();

        $recommandations = $urg['recommandation'];


        $manage=$this->getDoctrine()->getManager();
 
        foreach($recommandations as $recom){
            $re = new Recommandation();
            $re->setConseil($recom);
            $re->setSuivi($fiche);
            $manage->persist($re);
        }
        $manage->flush();

        return $this->json('ok');
    }

    /**
     * @Route("/suivi/{id}", name="suivi_show", methods={"GET"})
     */
    public function show(Suivi $suivi, SuiviRepository $repos): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $fiche=$repos->find($suivi);
        return $this->json($fiche, 200, [], $defaultContext);
    }

    /**
     * @Route("/modif/edit/{id}", name="suivi_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Suivi $suivi, SuiviRepository $repos): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            }
        ];
        
        $fiche = new Suivi();
        $request =$request->getContent();
        $urg=json_decode($request,true);
        $patient=$repos->findOneById($urg['patient']);
        $fiche->setPatient($patient);
        $fiche->setCretedAt(new \DateTime());
        $fiche->setPersonnel($this->getUser()->getPersonnel());
        $om=$this->getDoctrine()->getManager();
        $om->persist($fiche);
        $om->flush();
        return $this->json($fiche,200, [], $defaultContext);
    }

    /**
     * @Route("/supp/delete/{id}", name="suivi_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Suivi $suivi): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($suivi);
        $entityManager->flush();
        return $this->json('Suppression reussie');
    }
}
