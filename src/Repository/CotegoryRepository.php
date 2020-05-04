<?php

namespace App\Repository;

use App\Entity\Cotegory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cotegory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cotegory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cotegory[]    findAll()
 * @method Cotegory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CotegoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cotegory::class);
    }

    // /**
    //  * @return Cotegory[] Returns an array of Cotegory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cotegory
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
