<?php

namespace App\Repository;

use App\Entity\Attendance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Attendance>
 */
class AttendanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attendance::class);
    }

    public function findAllAttendance(?int $limit = null)
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.create_at', 'DESC');

            if ($limit !== null) {
                $qb->setMaxResults($limit);
            }
        
        return $qb
            ->getQuery()
            ->getResult();
    }

    public function findAttendanceById(int $id)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        
        return $qb;
    }

    public function countByStatus(string $status): int
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a.id)')
            ->join('a.status', 's')
            ->andWhere('s.label = :status')
            ->setParameter('status', $status)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countThisMonth(): int
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a.id)')
            ->andWhere('a.create_at BETWEEN :start AND :end')
            ->setParameter('start', new \DateTimeImmutable('first day of this month 00:00:00'))
            ->setParameter('end', new \DateTimeImmutable('last day of this month 23:59:59'))
            ->getQuery()
            ->getSingleScalarResult();
    }
}
