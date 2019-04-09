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
        $myOrder->setOrderstatus("Order Submitted");
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

        $orders = $repo->findBy(array('orderstatus' => array('submitted', 'outfordelivery')));

        return $this->render('order/driver.html.twig', ['orders'=>$orders]);
    }

    /**
     * @Route ("/updateOrder", name="updateOrder") methods={"GET", "POST"}
     */

     public function updateOrder() {

        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.
        $orderID = $request->request->get('orderid', 'none');
        $orderStatus = $request->request->get('orderStatus', 'none');

        $entityManager = $this->getDoctrine()->getManager();
        
        $orderToUpdate = $entityManager->getRepository(Buys::class)->find($orderID);

        if(!$orderToUpdate){
            throw $this->createNotFoundException(
                'No order found for id '.$orderStatus
            );
        }

        $orderToUpdate->setOrderStatus($orderStatus);
        $entityManager->persist($orderToUpdate);
        $entityManager->flush();

        $repo = $this->getDoctrine()->getRepository(Buys::class);
        $orders = $repo->findBy(array('orderstatus' => array('submitted', 'outfordelivery')));
        
        return $this->render('order/driver.html.twig', ['orders'=>$orders]);
     }
}
