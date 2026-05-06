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

    public function findAllAttendance()
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a')
            ->getQuery()
            ->getResult();
        
        return $qb;
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
}
