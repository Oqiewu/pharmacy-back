<?php

namespace App\Repository;

use App\Entity\TreatyType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TreatyType>
 *
 * @method TreatyType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TreatyType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TreatyType[]    findAll()
 * @method TreatyType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TreatyTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TreatyType::class);
    }

    public function save(TreatyType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TreatyType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findById(int $id): ?TreatyType
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findAllTreatyTypes(): array
    {
        return $this->findAll();
    }

//    /**
//     * @return TreatyType[] Returns an array of TreatyType objects
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

//    public function findOneBySomeField($value): ?TreatyType
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
