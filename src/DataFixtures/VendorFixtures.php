<?php

namespace App\DataFixtures;

use App\Entity\Vendor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VendorFixtures extends Fixture
{
    const VENDORS = [
        'nissan',
        'peugeot',
        'toyota',
        'mazda',
        'ford',
        'lexus',
        'citroen',
        'fiat',
        'honda',
        'kia',
        'mercedes',
        'renault',
        'hyundai'

    ];
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < count(self::VENDORS); $i++) {
            $vendor = new Vendor();
            $vendor->setName(self::VENDORS[$i]);
            $vendor->setLogo(self::VENDORS[$i] . '.jpg');
            $manager->persist($vendor);
        }

        $manager->flush();
    }
}
