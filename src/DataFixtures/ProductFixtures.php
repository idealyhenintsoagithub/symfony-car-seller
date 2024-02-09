<?php

namespace App\DataFixtures;

use App\Entity\Product;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
  public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 50; $i++) {
            $product = new Product();
            $product->setTitle('product '.$i);
            $product->setPriceTtc(mt_rand(10000, 1000000));
            $manager->persist($product);
        }

        $manager->flush();
    }
}