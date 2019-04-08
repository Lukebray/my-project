<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\Buys;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use DateTimeInterface;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order") methods={"GET", "POST"}
     */
    public function index()
    {
        return $this->render('order/index.html.twig');
    } 

    /**
     * @Route ("/ordersubmit", name="submit") methods={"GET", "POST"}
     */
    public function submit() {

        $request = Request::createFromGlobals(); 

        $order = $request->request->get('order', 'none');
        $amount = $request->request->get('amount', 'none');
        

        $entityManager = $this->getDoctrine()->getManager();

        $myOrder = new Buys();
        // $myOrder->setTimeOfOrder(DateTimeInterface::ATOM);
        $myOrder->setAmount($amount);
        $myOrder->setOrderstatus("In Progress");
        $myOrder->setOrderaddress("123 Fake Street Dublin");

        $entityManager->persist($myOrder);
        $entityManager->flush();

        return new Response (
            $myOrder->getAmount()
        );
            
        
    }

    /**
     * @Route ("/driver", name="driver") methods={"GET", "POST"}
     */
    public function driverOrders() {

        $repo = $this->getDoctrine()->getRepository(Buys::class);

        $orders = $repo->findAll();

        return $this->render('order/driver.html.twig', ['orders'=>$orders]);
    }
}
