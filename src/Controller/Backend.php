<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Login;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;  

class Backend extends AbstractController
{
    /**
     * @Route("/backend", name="catch") methods={"GET","POST"}
     */
    public function index()
    {
        
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.

        $type = $request->request->get('type', 'none'); // to send ourself in different directions
        
        if($type == 'register'){
            //start session
            
            // perform register process
            
            // get the variables
            $username = $request->request->get('username', 'none');
            $password = $request->request->get('password', 'none');
            $acctype = $request->request->get('acctype', 'none');
                        
            // put in the database            
             $entityManager = $this->getDoctrine()->getManager();

              $user = new Login();
              $user->setUsername($username);
              $user->setPassword($password);
              $user->setAcctype($acctype);
              $user->setStatus("Active");

             $entityManager->persist($user);

             // actually executes the queries (i.e. the INSERT query)
             $entityManager->flush();             
                        
             return new Response(
                     $user->getAcctype()
                    );  
        }
        
        else if($type == 'login'){ // if we had a login

            // get the username and password
            $username = $request->request->get('username', 'none');
            $password = $request->request->get('password', 'none');
            $acctype = $request->request->get('acctype', 'none');
            
            
            $repo = $this->getDoctrine()->getRepository(Login::class); // the type of the entity
             
             
            $person = $repo->findOneBy([
                'username' => $username,
                'password' => $password,
                ]);

                return new Response(
                    $person->getAcctype()
                    );                 
        }
    }
}