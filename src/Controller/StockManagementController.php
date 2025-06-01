<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Form\AddProductStockType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/stock")
 */
class StockManagementController extends AbstractController
{
    /**
     * @Route("/management", name="app_stock_management")
     */
    public function index(
        Request $request, 
        ProductRepository $productRepository, 
        EntityManagerInterface $em
    ): Response
    {
        return $this->render('stock_management/index.html.twig', [
            'products' => $productRepository->findAll()
        ]);
    }
    
    /**
     * @Route("/add/{id}/product", name="app_stock_management_add")
     */
    public function addProductStock(
        Product $product,
        Request $request, 
        ProductRepository $productRepository, 
        EntityManagerInterface $em
    ): Response
    {
        $form = $this->createForm(AddProductStockType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $product->setStock($data->getStock() + $product->getStock());
            
            $em->flush();
            return $this->redirectToRoute('app_stock_management');
        }

        return $this->render('stock_management/add-product-stock.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/remove/{id}/product", name="app_stock_management_remove")
     */
    public function removeProductStock(
        Product $product,
        Request $request, 
        ProductRepository $productRepository, 
        EntityManagerInterface $em
    ): Response
    {
        $form = $this->createForm(AddProductStockType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $product->setStock($product->getStock() - $data->getStock());
            
            if ($product->getStock() < 0) {
                $product->setStock(0);
            }

            $em->flush();
            return $this->redirectToRoute('app_stock_management');
        }

        return $this->render('stock_management/remove-product-stock.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}
