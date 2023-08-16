<?php

namespace App\Repository;

use App\Entity\Subtype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Subtype>
 *
 * @method Subtype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subtype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subtype[]    findAll()
 * @method Subtype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubtypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subtype::class);
    }

    public function save(Subtype $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Subtype $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findById(int $id): ?Subtype
    {
        return $this->findOneBy(["id" => $id]);
    }

    public function findAllSubtypes(): array
    {
        return $this->findAll();
    }

//    /**
//     * @return Subtype[] Returns an array of Subtype objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }
   /**
    * @return Subtype[] Returns an array of Organization objects
    */
    public function findByType(int $value): array
    {
        return $this->createQueryBuilder('s')
            ->where('s.type = :val')
            ->setParameter('val', $value)
            ->orderBy('s.type', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
