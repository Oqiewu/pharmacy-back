<?php

namespace App\Repository;

use App\Entity\Treaty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Treaty>
 *
 * @method Treaty|null find($id, $lockMode = null, $lockVersion = null)
 * @method Treaty|null findOneBy(array $criteria, array $orderBy = null)
 * @method Treaty[]    findAll()
 * @method Treaty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TreatyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Treaty::class);
    }

    public function save(Treaty $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Treaty $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findById(int $id): ?Treaty
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findAllTreaties(): array
    {
        return $this->findAll();
    }

//    /**
//     * @return Treaty[] Returns an array of Treaty objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Treaty
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
