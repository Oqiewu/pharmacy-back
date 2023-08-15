<?php

namespace App\Repository;

use App\Entity\BarCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Manufacturer;

/**
 * @extends ServiceEntityRepository<BarCode>
 *
 * @method BarCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method BarCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method BarCode[]    findAll()
 * @method BarCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BarCode::class);
    }

    public function save(BarCode $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BarCode $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findById(int $id): ?BarCode
    {
        return $this->findOneBy(["id" => $id]);
    }

    public function findAllBarCodes(): array
    {
        return $this->findAll();
    }
    
    /**
    * @return BarCode[] Returns an array of Barcode objects
    */
   public function findByManufacturer(int $value): array
   {
       return $this->createQueryBuilder('b')
           ->andWhere('b.manufacturer = :val')
           ->setParameter('val', $value)
           ->orderBy('b.manufacturer', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }

//    /**
//     * @return BarCode[] Returns an array of BarCode objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BarCode
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
