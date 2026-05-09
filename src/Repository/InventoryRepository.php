<?php

namespace App\Repository;

use App\Entity\Inventory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Inventory>
 */
class InventoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inventory::class);
    }

    //    /**
    //     * @return Inventory[] Returns an array of Inventory objects
    //     */
       public function findAllEquipment(?int $limit = null): array
       {
            $qb = $this->createQueryBuilder('e')
               ->orderBy('e.name', 'ASC');

            if ($limit !== null) {
                $qb->setMaxResults($limit);
            };
               
            return $qb
                ->getQuery()
                ->getResult();
       }

       public function findOneById(int $id)
       {
            return $this->createQueryBuilder('i')
                ->select('i')
                ->where('i.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getOneOrNullResult();
        }
}
