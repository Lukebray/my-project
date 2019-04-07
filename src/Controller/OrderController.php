<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\Order;
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
        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.

        $repo = $this->getDoctrine()->getRepository(Product::class); // the type of the entity

        $products = $repo->findAll();

        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController', 'result' => $products
        ]);
    } 
    /**
     * @Route ("/ordersubmit", name="submit") methods={"GET", "POST"}
     */
    public function submit() {

        $request = Request::createFromGlobals(); // the envelope, and were looking inside it.

        $order = $request->request->get('order', 'none');
        $amount = $request->request->get('amount', 'none');

        $entityManager = $this->getDoctrine()->getManager();

        $myOrder = new Order();
        // $myOrder->setTimeOfOrder(DateTimeInterface::ATOM);
        $myOrder->setAmount($amount);
        $myOrder->setStatus("On the way");
        $myOrder->setDeliveryAddress("123 Fake Street, Dublin");
        // $myOrder->setCustomerId(123);

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

        $repo = $this->getDoctrine()->getRepository(Order::class);
        $orders = $repo->findAll();

        return $this->render('order/driver.html.twig', ['orders'=>$orders]);
    }
}
