<?php

namespace App\Repository;

use App\Entity\ActiveSubstance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ActiveSubstance>
 *
 * @method ActiveSubstance|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiveSubstance|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiveSubstance[]    findAll()
 * @method ActiveSubstance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiveSubstanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActiveSubstance::class);
    }

    public function save(ActiveSubstance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ActiveSubstance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findById(int $id): ?ActiveSubstance
    {
        return $this->findOneBy(["id" => $id]);
    }

    public function findAllActiveSubstances(): array
    {
        return $this->findAll();
    }

//    /**
//     * @return ActiveSubstance[] Returns an array of ActiveSubstance objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ActiveSubstance
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
