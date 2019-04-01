<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\Order;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 

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
}
