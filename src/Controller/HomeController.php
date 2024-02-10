<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Vendor;
use App\Entity\OrderItem;
use App\Form\AddToCartType;
use App\Manager\CartManager;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    public function productDetail(
        Product $product, 
        EntityManagerInterface $entityMananger,
        Request $request,
        CartManager $cartManager 
    ): Response
    {
        
        $form = $this->createForm(AddToCartType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orderItem = $form->getData();
            $orderItem->setProduct($product);

            $cart = $cartManager->getCurrentCart();
            $cart
                ->addOrderItem($orderItem)
                ->setUpdatedAt(new \DateTimeImmutable());

            $cartManager->save($cart);

            return $this->redirectToRoute('product_detail', ['id' => $product->getId()]);
        }

        return $this->render('home/details.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}
