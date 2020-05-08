<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * @Route("user")
 */
class UserController extends AbstractController
{
    private $passwordEncoder;
    public function __construct (UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/", name="user")
     *                                              
     */
    public function index(UserRepository $repos)
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return 'symfony 4';
            }
        ];

        $users = $repos->findAll();
        return $this->json($users, 200, [], $defaultContext);
    }

    /**
     * @Route("/new", name="new_user")
     */
    public function new(Request $request)
    {
        
        $request = $request->getContent();
        $user = new User();
        $use = json_decode($request, true);
        $p =$this->passwordEncoder->encodePassword($user, $use['password']);
        $user->setEmail($use['email']);
        $user->setPassword($p);
        $om  = $this->getDoctrine()->getManager();
        $om->persist($user);
        $om->flush();
        return $this->json('ok');
    }
}
