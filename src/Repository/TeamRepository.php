<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Team>
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function findAllPlayer()
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t')
            ->getQuery()
            ->getResult();
        
        return $qb;
    }

    public function findPlayerById(int $id)
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        
        return $qb;
    }
}
