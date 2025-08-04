<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Product;
use App\Entity\Vendor;
use App\Entity\OrderItem;
use App\Form\AddToCartType;
use App\Manager\CartManager;
use App\Repository\ProductRepository;
use App\Repository\VendorRepository;
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
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $topBrands = [
            'Volkswagen',
            'Volvo',
            'Mercedes-benz',
            'Mazda',
            'Tesla',
            'Toyota',
            'Kia',
            'Renault',
            'Ford',
            'Opel',
            'Peugeot',
            'Suzuki',
            'Hyundai',
            'Nissan',
            'Lexus',
            'Land Rover',
            'Lamborghini',
            'Gmc',
            'Honda',
            'Ferrari',
        ];
        $products = [];
        $query = $request->query->get('logo');
        $shouldScroll = false;

        if ($query) {
            $products = $entityManager
                ->getRepository(Product::class)
                ->getProductByBrand($query);
            $shouldScroll = true;
        } else {
            $products = $entityManager->getRepository(Product::class)->findAll();
        }
        $brands = $entityManager->getRepository(Brand::class)->getTopBrand($topBrands);
        
        return $this->render('shop/home/index.html.twig', [
            'products' => $products,
            'brands' => $brands,
            'shouldScroll' => $shouldScroll,
        ]);
    }

    /**
     * @Route("/details/{id}", name="product_detail")
     */
    public function productDetail(
        Product $product, 
        EntityManagerInterface $entityMananger,
        Request $request,
        CartManager $cartManager,
        ProductRepository $productRepository
    ): Response
    {
        
        $form = $this->createForm(AddToCartType::class);
        $form->handleRequest($request);
        $relativeProducts = $productRepository->getRelativeProducts($product);

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

        return $this->render('shop/home/product-details.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
            'relativeProducts' => $relativeProducts
        ]);
    }

    /**
     * @Route("/producs/{categoryName}", name="products_by_category")
     */
    public function productsByCategory(
        string $categoryName,
        ProductRepository $productRepository,
        VendorRepository $vendorRepository
    )
    {
        $vendor = $vendorRepository->findOneByName($categoryName);
        $products = $productRepository->findByBrand($vendor);

        return $this->render('home/product-per-category.html.twig', [
            'categoryName' => $categoryName,
            'products' => $products,
        ]);
    }
}
