<?php

namespace App\Repository;

use App\Entity\SoleTrader;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SoleTrader>
 *
 * @method SoleTrader|null find($id, $lockMode = null, $lockVersion = null)
 * @method SoleTrader|null findOneBy(array $criteria, array $orderBy = null)
 * @method SoleTrader[]    findAll()
 * @method SoleTrader[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoleTraderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SoleTrader::class);
    }

    public function save(SoleTrader $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SoleTrader $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findAllSoleTraders(): array
    {
        return $this->findAll();
    }

    public function findById(int $id): ?SoleTrader
    {
        return $this->findOneBy(["id" => $id]);
    }
}
