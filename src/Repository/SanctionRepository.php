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

    public function findAllSanction(?int $limit = null)
    {
        $qb = $this->createQueryBuilder('s')
            ->orderBy('s.create_at', 'DESC');

            if ($limit !== null) {
                $qb->setMaxResults($limit);
            }
        
        return $qb
            ->getQuery()
            ->getResult();
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
