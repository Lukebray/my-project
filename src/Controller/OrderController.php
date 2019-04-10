<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\Buys;
use App\Entity\Login;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use DateTimeInterface;

class OrderController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }
    /**
     * @Route("/order", name="order") methods={"GET", "POST"}
     */
    public function index(SessionInterface $session)
    {
        return $this->render('order/index.html.twig');
    } 

    /**
     * @Route ("/ordersubmit", name="submit") methods={"GET", "POST"}
     */
    public function submit(SessionInterface $session) {

        $request = Request::createFromGlobals(); 

        $order = $request->request->get('order', 'none');
        $amount = $request->request->get('amount', 'none');
        $addr = $request->request->get('address', 'none');
        

        $entityManager = $this->getDoctrine()->getManager();

        $relatedCustomer = $this->getDoctrine()->getRepository(Login::class)->find($session->get('userid'));

        $myOrder = new Buys();
        // $myOrder->setTimeOfOrder(DateTimeInterface::ATOM);
        $myOrder->setAmount($amount);
        $myOrder->setOrderstatus("Order Submitted");
        $myOrder->setOrderaddress($addr);
        $myOrder->setCustomerId($relatedCustomer);

        $entityManager->persist($myOrder);
        $entityManager->flush();

        return new Response (
            $myOrder->getAmount()
        );
            
        
    }

    /**
     * @Route ("/driver", name="driver") methods={"GET", "POST"}
     */
    public function driverOrders(SessionInterface $session) {

        $repo = $this->getDoctrine()->getRepository(Buys::class);

        $orders = $repo->findBy(array('orderstatus' => array('submitted', 'outfordelivery')));

        return $this->render('order/driver.html.twig', ['orders'=>$orders]);
    }

    /**
     * @Route ("/updateOrder", name="updateOrder") methods={"GET", "POST"}
     */

     public function updateOrder(SessionInterface $session) {

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
