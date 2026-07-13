<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Product;
use App\Entity\Vendor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    private const MODEL_NAMES = [
        '208', '3008', '308', '508', 'C3', 'C4', 'A1', 'A3', 'A4', 'Clio',
        'Mégane', 'Civic', 'Corolla', 'Yaris', 'CX-5', 'MX-5', 'Focus', 'Kuga',
        'Rio', 'Sportage', 'C-Class', 'E-Class', 'GLA', 'GLC', 'Prius', 'RAV4',
        'Qashqai', 'Juke', 'Micra', 'Leaf', 'i20', 'i30', 'Tucson', 'Santa Fe'
    ];

    private const TRIMS = ['Essential', 'Business', 'Style', 'GT Line', 'Comfort', 'Signature', 'Edition'];

    public function load(ObjectManager $manager): void
    {
        $vendors = $manager->getRepository(Vendor::class)->findAll();

        if (empty($vendors)) {
            return;
        }

        $brandsByName = [];

        for ($i = 0; $i < 100; $i++) {
            $vendor = $vendors[$i % count($vendors)];
            $vendorName = $vendor->getName();

            if (!isset($brandsByName[$vendorName])) {
                $brand = new Brand();
                $brand->setName(ucwords($vendorName));
                $brand->setLogo($vendorName . '.jpg');
                $manager->persist($brand);
                $brandsByName[$vendorName] = $brand;
            }

            $product = new Product();
            $modelName = self::MODEL_NAMES[$i % count(self::MODEL_NAMES)];
            $trim = self::TRIMS[$i % count(self::TRIMS)];
            $product->setTitle(sprintf('%s %s %s', ucwords($vendorName), $modelName, $trim));
            $product->setDescription(sprintf('Voiture %s en excellent état, idéale pour un usage quotidien ou un trajet urbain.', $modelName));
            $product->setStock(rand(1, 12));
            $product->setPriceTtc(12000 + ($i * 350) + rand(0, 10) * 100);
            $product->setImage(sprintf('car-%02d.jpg', $i + 1));
            $product->setVendor($vendor);
            $product->setBrand($brandsByName[$vendorName]);
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            VendorFixtures::class,
        ];
    }
}
