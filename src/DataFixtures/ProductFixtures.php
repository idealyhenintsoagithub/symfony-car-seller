<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Repository\VendorRepository;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    const PRODUCTS = [
        [
          "title" => "Mercedes-Benz",
          "gender" => "Citan",
          "type" => "van",
          "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
          "priceTtc" => 10000,
          "vendor" => "mercedes",
          "image" => "mercedes_citan.jpg"
        ],
        [
          "title" => "Lexus",
          "gender" => "GX",
          "type" => "4WD",
          "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
          "priceTtc" => 50000,
          "vendor" => "lexus",
          "image" => "lexus_gx.jpg"
        ],
        [
          "title" => "Toyota",
          "gender" => "RAV4",
          "type" => "crossover",
          "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
          "priceTtc" => 15000,
          "vendor" => "toyota",
          "image" => "toyota_rav4.webp"
        ],
        [
          "title" => "Hyundai",
          "gender" => "Grand i10 Nios",
          "type" => "hatchback",
          "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
          "vendor" => "hyundai",
          "image" => "hyundai_i10.webp",
          "priceTtc" => 43000,
        ],
        [
          "title" => "Honda",
          "gender" => "Civic",
          "type" => "sedan",
          "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
          "priceTtc" => 25000,
          "vendor" => "honda",
          "image" => "honda_civic.jpg"
        ]
    ];


    /**
     * @param VendorRepository $name
     */
    private $vendorRepository;

    public function __construct(VendorRepository $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
    }
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < count(self::PRODUCTS); $i++) {
            $product = new Product();

            $brand = $this->vendorRepository->findOneBy(['name' => self::PRODUCTS[$i]['vendor']]);
            $product->setTitle(self::PRODUCTS[$i]['title']);
            
            $product->setPriceTtc(self::PRODUCTS[$i]['priceTtc']);
            $product->setType(self::PRODUCTS[$i]['type']);
            
            $product->setGender(self::PRODUCTS[$i]['gender']);
            $product->setDescription(self::PRODUCTS[$i]['description']);
            
            $product->setBrand($brand);
            $product->setStock(rand(1, 9));
            $product->setImage(self::PRODUCTS[$i]['image']);

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            VendorFixtures::class
        ];
    }
}