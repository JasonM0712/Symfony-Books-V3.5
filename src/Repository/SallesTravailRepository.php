<?php

namespace App\Repository;

use App\Entity\SallesTravail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SallesTravail>
 *
 * @method SallesTravail|null find($id, $lockMode = null, $lockVersion = null)
 * @method SallesTravail|null findOneBy(array $criteria, array $orderBy = null)
 * @method SallesTravail[]    findAll()
 * @method SallesTravail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SallesTravailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SallesTravail::class);
    }

//    /**
//     * @return SallesTravail[] Returns an array of SallesTravail objects
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

//    public function findOneBySomeField($value): ?SallesTravail
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
