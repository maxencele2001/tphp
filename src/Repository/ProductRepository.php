<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
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

    private function findVisibleDisplay() : QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.display = true');
    }

    public function findLatest()
    {
        return $this->findVisibleDisplay()
            ->orderBy('p.created_at', 'DESC')
            ->setMaxResults(Product::TOP)
            ->getQuery()
            ->getResult();
    }

    public function findAllVisible()
    {
        return $this->findVisibleDisplay()
            ->getQuery()
            ->getResult();
    }

    public function findPromo()
    {
        return $this->findVisibleDisplay()
            ->andWhere('p.promo = true')
            ->getQuery()
            ->getResult();
    }

    public function getByID(int $id)
    {
        return $this->findVisibleDisplay()
            ->andWhere('p.category = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
