<?php

namespace App\Repository;

use App\Entity\TrainingSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TrainingSession>
 */
class TrainingSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainingSession::class);
    }

    public function findAllTraining()
    {
        $qb = $this->createQueryBuilder('ts')
            ->select('ts')
            ->getQuery()
            ->getResult();
        
        return $qb;
    }

    public function findTrainingById(int $id)
    {
        $qb = $this->createQueryBuilder('ts')
            ->select('ts')
            ->where('ts.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        
        return $qb;
    }
}
