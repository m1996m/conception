<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use App\Repository\PatientRepository;
use App\Repository\PersonnelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * @Route("api/message")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/", name="message_index", methods={"GET","POST"})
     */
    public function index(MessageRepository $messageRepository): Response
    {
        //$patients = $patientRepository->findOneBy(['personnel'=>$this->getUser()->getPersonnel()]);
        $messages = $messageRepository->findAll();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        return $this->json($messages, 200, [], $defaultContext);
    }



    /*
    public function index(\Swift_Mailer $mailer)
    {
        /*$message = (new \Swift_Message('Bonjour'))
        ->setFrom('tbbarry8@gmail.com')
        ->setTo('mmd1996.m@gmail.com')
        ->setBody('message');
        $mailer->send($message);
        return $this->json('message');
        
    }*/
    /**
     * @Route("/new", name="message_new", methods={"GET","POST"})
     */
    public function new(Request $request, PersonnelRepository $perso, PatientRepository  $pati): Response
    {
       $request = $request->getContent();
       $message = new Message();
       $pat = json_decode($request, true);
       $personnel=$perso->findOneById($pat['destinateur']);
       $patient=$pati->findOneById($pat['destinateur']);
       $connecter=$this->getUser()->getRoles();
       $message->setContent($pat['nom']);
       if($connecter=="user"){
            $message->setPatient($patient);
       }else if($connecter=="personnel"){
            $message->setPersonnel($personnel);
       }
       $message->setCreatedAt(new \DateTime());
       $om=$this->getDoctrine()->getManager();
       $om->persist($message);
       $om->flush();
       
       return $this->json("ok");
    }

     /**
     * @Route("/message/{id}", name="message_show", methods={"GET"})
     */
    public function show(Message $massage,PatientRepository $repos): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $massages = $repos->find($massage);
        return $this->json($massages, 200, [], $defaultContext);
    } 

    /**
     * @Route("/modif/edit/{id}", name="message_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Message $message, PersonnelRepository $perso, PatientRepository  $pati): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            },
        ];
        $request = $request->getContent();
        $message = new Message();
        $pat = json_decode($request, true);
        $personnel=$perso->findOneById($pat['destinateur']);
        $patient=$pati->findOneById($pat['destinateur']);
        $connecter=$this->getUser()->getRoles();
        $message->setContent($pat['nom']);
        if($connecter=="user"){
             $message->setPatient($patient);
        }else if($connecter=="personnel"){
             $message->setPersonnel($personnel);
        }
        $message->setCreatedAt(new \DateTime());
        $om=$this->getDoctrine()->getManager();
        $om->flush();
        
        return $this->json($message, 200, [], $defaultContext);
    }

    /**
     * @Route("/supp/delete/{id}", name="message_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Message $message): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($message);
        $entityManager->flush();

        return $this->redirectToRoute('message_index');
    }
}
