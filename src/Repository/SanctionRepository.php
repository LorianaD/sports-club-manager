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

    public function countByType(string $type): int
    {
        return $this->createQueryBuilder('s')
            ->select('COUNT(s.id)')
            ->andWhere('s.type = :type')
            ->setParameter('type', $type)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countThisMonth(): int
    {
        return $this->createQueryBuilder('s')
            ->select('COUNT(s.id)')
            ->andWhere('s.create_at BETWEEN :start AND :end')
            ->setParameter('start', new \DateTimeImmutable('first day of this month 00:00:00'))
            ->setParameter('end', new \DateTimeImmutable('last day of this month 23:59:59'))
            ->getQuery()
            ->getSingleScalarResult();
    }    
}
