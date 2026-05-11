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

    public function findAllTraining(?int $limit = null)
    {
        $qb = $this->createQueryBuilder('ts')
            ->orderBy('ts.date', 'DESC')
            ->addOrderBy('ts.time', 'DESC');

            if ($limit !== null) {
                $qb->setMaxResults($limit);
            }
        
        return $qb
            ->getQuery()
            ->getResult();
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

    public function findNextTrainings(int $limit = 2): array
    {
        return $this->createQueryBuilder('ts')
            ->andWhere('ts.date >= :today')
            ->setParameter('today', new \DateTimeImmutable('today'))
            ->orderBy('ts.date', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
