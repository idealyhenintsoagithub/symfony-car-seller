<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Form\ClientClientType;
use App\Manager\CartManager;
use App\Entity\Order;
use App\Form\CartType;
use App\Manager\StockManager;

use Doctrine\ORM\EntityManagerInterface;
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
        $message = $request->query->get("message");

        $form = $this->createForm(CartType::class, $currentCart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentCart->setUpdatedAt(new \DateTimeImmutable());
            $cartManager->save($currentCart);

            return $this->redirectToRoute("app_cart");
        }

        return $this->render('cart/index.html.twig', [
            'form' => $form->createView(),
            'cart' => $currentCart,
            'message' => $message,
        ]);
    }

    /**
     * @Route("/validate-cart", name="app_validate_cart")
     */
    public function validateCarte(
        Request $request, 
        EntityManagerInterface $em, 
        CartManager $cartManager,
        StockManager $stockManager
    )
    {
        $user = $this->getUser();
        $client = new Client();
        $cart = $cartManager->getCurrentCart();

        if ($user) {
            $client = $user->getClient();
        }
        
        $form = $this->createForm(ClientClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cart->setClient($client);
            $cart->setStatus(Order::STATUS_CART_VALIDATE);

            $stockManager->process($cart);
            
            $em->flush();
            return $this->redirectToRoute('app_cart', [
                'message' => 'Votre commande est enregistrée',
                'status' => 'success'
            ]);
        }

        return $this->render("cart/validate-cart.html.twig", [
            'form' => $form->createView()
        ]);
    }
}
