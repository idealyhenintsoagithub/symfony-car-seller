<?php

namespace App\Controller;

use App\Repository\VendorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavbarController extends AbstractController
{
    #[Route('/navbar', name: 'app_navbar')]
    public function index(EntityManagerInterface $em, VendorRepository $vendorRepository): Response
    {
        $allSuppliers = $vendorRepository->findAll();

        return $this->render('layout/navbar.html.twig', [
            'suppliers' => $allSuppliers,
        ]);
    }
}
