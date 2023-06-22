<?php

namespace App\Repository;

use App\Entity\GoodsMargin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GoodsMargin>
 *
 * @method GoodsMargin|null find($id, $lockMode = null, $lockVersion = null)
 * @method GoodsMargin|null findOneBy(array $criteria, array $orderBy = null)
 * @method GoodsMargin[]    findAll()
 * @method GoodsMargin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GoodsMarginRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GoodsMargin::class);
    }

    public function save(GoodsMargin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GoodsMargin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findById(int $id): ?GoodsMargin
    {
        return $this->findOneBy(["id" => $id]);
    }

    public function findAllGoodsMargins(): array
    {
        return $this->findAll();
    }

//    /**
//     * @return GoodsMargin[] Returns an array of GoodsMargin objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GoodsMargin
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
