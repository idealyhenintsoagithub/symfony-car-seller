<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getRelativeProducts(Product $product): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.brand', 'brand')
            ->andWhere('brand = :brand')
            ->andWhere('p != :currentProduct')
            ->setParameter('brand', $product->getBrand())
            ->setParameter('currentProduct', $product)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
       ;
    }

    public function getProductPerVendor(): array
    {
        return $this->createQueryBuilder('p')
            ->select('brand.name vendor, COUNT(p) productNumber')
            ->join('p.brand', 'brand')
            ->groupBy('brand')
            ->orderBy('p.createdAt', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getProductByBrand(String $brand)
    {
        return $this->createQueryBuilder('p')
                ->join('p.brand', 'brand')
                ->where('brand.name LIKE :brandName')
                ->setParameter('brandName', '%'.$brand.'%')
                ->getQuery()
                ->getResult();
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
