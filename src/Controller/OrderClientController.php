<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/order")
 */
class OrderClientController extends AbstractController
{
    /**
     * @Route("/", name="app_client_order")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        $user = $this->getUser();
        $userOrders = $orderRepository->findBy(['client' => $user->getClient()]);

        return $this->render('order/index.html.twig', [
            'orders' => $userOrders
        ]);
    }
}
