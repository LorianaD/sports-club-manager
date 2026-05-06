<?php

namespace App\Repository;

use App\Entity\Sanction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sanction>
 */
class SanctionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sanction::class);
    }

    public function findAllSanction()
    {
        $qb = $this->createQueryBuilder('s')
            ->select('s')
            ->getQuery()
            ->getResult();
        
        return $qb;
    }

    public function findSanctionById(int $id)
    {
        $qb = $this->createQueryBuilder('s')
            ->select('s')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        
        return $qb;
    }
}
