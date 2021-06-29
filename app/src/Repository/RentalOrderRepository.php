<?php

namespace App\Repository;

use App\Entity\RentalOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RentalOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentalOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentalOrder[]    findAll()
 * @method RentalOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentalOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentalOrder::class);
    }

    public function findOrdersAfterDate(\DateTime $startDate): ?array
    {
        return $this->createQueryBuilder('ro')
            ->andWhere('ro.startDate >= :startDate OR ro.endDate >= :startDate')
            ->setParameter('startDate', $startDate->format('Y-m-d h:i:s'))
            ->getQuery()
            ->getResult();
    }
}
