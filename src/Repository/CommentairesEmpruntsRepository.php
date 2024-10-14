<?php

namespace App\Repository;

use App\Entity\CommentairesEmprunts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommentairesEmprunts>
 *
 * @method CommentairesEmprunts|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentairesEmprunts|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentairesEmprunts[]    findAll()
 * @method CommentairesEmprunts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentairesEmpruntsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentairesEmprunts::class);
    }

//    /**
//     * @return CommentairesEmprunts[] Returns an array of CommentairesEmprunts objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CommentairesEmprunts
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
