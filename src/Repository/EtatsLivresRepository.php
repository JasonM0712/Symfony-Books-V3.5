<?php

namespace App\Repository;

use App\Entity\EtatsLivres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EtatsLivres>
 *
 * @method EtatsLivres|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatsLivres|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatsLivres[]    findAll()
 * @method EtatsLivres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatsLivresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatsLivres::class);
    }

//    /**
//     * @return EtatsLivres[] Returns an array of EtatsLivres objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EtatsLivres
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
