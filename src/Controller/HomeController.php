<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Vendor;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $products = $entityManager->getRepository(Product::class)->findAll();
        $vendors = $entityManager->getRepository(Vendor::class)->findAll();

        return $this->render('home/index.html.twig', [
            'products' => $products,
            'vendors' => $vendors
        ]);
    }

    /**
     * @Route("/details/{id}", name="product_detail")
     */
    public function productDetail($id, EntityManagerInterface $entityMananger): Response
    {
        $product = $entityMananger->getRepository(Product::class)->findOneBy(["id" => $id]);

        return $this->render('home/details.html.twig', [
            'product' => $product
        ]);
    }
}
