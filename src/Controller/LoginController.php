<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Login;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"GET","POST"})
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new Login();
        $user->setUsername();
        $user->setPassword('123456');
        $user->setAcctype('customer');

        $entityManager->persist($user);

        $entityManager->flush();

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
}
