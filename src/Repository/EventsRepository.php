<?php

namespace App\Repository;

use App\Entity\Events;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Events>
 */
class EventsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Events::class);
    }

    public function findAllEvent(?int $limit = null)
    {
        $qb = $this->createQueryBuilder('e')
            ->orderBy('e.date', 'DESC');

            if ($limit !== null) {
                $qb->setMaxResults($limit);
            }
        
        return $qb
            ->getQuery()
            ->getResult();
    }

    public function findEventById(int $id)
    {
        $qb = $this->createQueryBuilder('e')
            ->select('e')
            ->where('e.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        
        return $qb;
    }

    public function findNextEvents(int $limit = 2): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.date >= :today')
            ->setParameter('today', new \DateTimeImmutable('today'))
            ->orderBy('e.date', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
