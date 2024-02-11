<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="app_order")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('order/index.html.twig', [
            'orders' => $orderRepository->findBy(['status' => Order::STATUS_CART_VALIDATE])
        ]);
    }

    /**
     * @Route("/order/{id}/details", name="app_order_details")
     */
    public function orderDetails(Order $order)
    {
        return $this->render('order/order-details.html.twig', [
            'order' => $order
        ]);
    }
}
