<?php

namespace App\Repository;

use App\Entity\Campervan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Campervan|null find($id, $lockMode = null, $lockVersion = null)
 * @method Campervan|null findOneBy(array $criteria, array $orderBy = null)
 * @method Campervan[]    findAll()
 * @method Campervan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampervanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campervan::class);
    }

    // /**
    //  * @return Campervan[] Returns an array of Campervan objects
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
    public function findOneBySomeField($value): ?Campervan
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
