<?php

namespace App\Repository;

use App\Entity\Livres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Adapter\DoctrineORMAdapter;

/**
 * @extends ServiceEntityRepository<Livres>
 *
 * @method Livres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livres[]    findAll()
 * @method Livres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livres::class);
    }

    public function findBooksBySearchData(SearchData $searchData)
    {
        $query = $this->createQueryBuilder('l');

        // Appliquer les critères de recherche si nécessaire
        if (!empty($searchData->getQuery())) {
            $query->andWhere('l.nom LIKE :query')
                ->setParameter('query', '%' . $searchData->getQuery() . '%');
        }

        return $query->getQuery();
    }

    public function search($data)
    {
        $queryBuilder = $this->createQueryBuilder('l');
        if (!empty($data->query)) {
            $queryBuilder
                ->andWhere('l.nom LIKE :query')
                ->setParameter('query', '%' . $data->query . '%');
        }

        $queryBuilder->setMaxResults(10);

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    public function findPositionMax()
    {
        return $this->createQueryBuilder('l')
            ->select('MAX(l.Position) as positionMax')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findAllPaginated(int $page = 1, int $limit = 10): Pagerfanta
    {
        $queryBuilder = $this->createQueryBuilder('l')
            ->orderBy('l.Position', 'ASC');

        $pagerfanta = new Pagerfanta(new QueryAdapter($queryBuilder));
        $pagerfanta->setMaxPerPage($limit);
        $pagerfanta->setCurrentPage($page);

        return $pagerfanta;
    }

//    /**
//     * @return Livres[] Returns an array of Livres objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Livres
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
