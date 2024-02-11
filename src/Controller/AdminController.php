<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\ProductRepository;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(
        ProductRepository $productRepository, 
        OrderRepository $orderRepository,
        UserRepository $userRepository
    ): Response
    {
        $productPerVendor = $productRepository->getProductPerVendor();
        $parsedData = [];

        foreach ($productPerVendor as $product) {
            $parsedData[] = [
                $product['vendor'] => $product['productNumber']
            ];
        }

        $totalOrder = $orderRepository->getTotalOrder();
        $totalOrderValues = $orderRepository->findBy(['status' => Order::STATUS_CART_VALIDATE]);
        $total = 0;

        foreach ($totalOrderValues as $value) {
            $total += $value->getTotal();
        }

        return $this->render('admin/index.html.twig', [
            'productPerVendor' => $parsedData,
            'totalOrder' => $totalOrder,
            'totalOrderValues' => $total / 1000,
            'userTotal' => count($userRepository->findAll())
        ]);
    }
}
