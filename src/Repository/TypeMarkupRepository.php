<?php

namespace App\Repository;

use App\Entity\TypeMarkup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeMarkup>
 *
 * @method TypeMarkup|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeMarkup|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeMarkup[]    findAll()
 * @method TypeMarkup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeMarkupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeMarkup::class);
    }

    public function save(TypeMarkup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TypeMarkup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllTypeMarkups(): array
    {
        return $this->findAll();
    }

//    /**
//     * @return TypeMarkup[] Returns an array of TypeMarkup objects
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

//    public function findOneBySomeField($value): ?TypeMarkup
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
