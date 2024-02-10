<?php

namespace App\Controller;

use App\Manager\CartManager;
use App\Entity\Order;
use App\Form\CartType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="app_cart")
     */
    public function index(Request $request, CartManager $cartManager): Response
    {
        $currentCart = $cartManager->getCurrentCart();

        $form = $this->createForm(CartType::class, $currentCart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentCart->setUpdatedAt(new \DateTimeImmutable());
            $cartManager->save($currentCart);

            return $this->redirectToRoute("app_cart");
        }

        return $this->render('cart/index.html.twig', [
            'form' => $form->createView(),
            'cart' => $currentCart
        ]);
    }
}
