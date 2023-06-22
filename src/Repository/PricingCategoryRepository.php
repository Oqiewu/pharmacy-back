<?php

namespace App\Repository;

use App\Entity\PricingCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PricingCategory>
 *
 * @method PricingCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PricingCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PricingCategory[]    findAll()
 * @method PricingCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PricingCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PricingCategory::class);
    }

    public function save(PricingCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PricingCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findById(int $id): ?PricingCategory
    {
        return $this->findOneBy(["id" => $id]);
    }

    public function findAllPricingCategory(): array
    {
        return $this->findAll();
    }

//    /**
//     * @return PricingCategory[] Returns an array of PricingCategory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PricingCategory
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
