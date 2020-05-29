<?php

namespace App\Repository;

use App\Entity\FreeCourse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FreeCourse|null find($id, $lockMode = null, $lockVersion = null)
 * @method FreeCourse|null findOneBy(array $criteria, array $orderBy = null)
 * @method FreeCourse[]    findAll()
 * @method FreeCourse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FreeCourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FreeCourse::class);
    }

    // /**
    //  * @return FreeCourse[] Returns an array of FreeCourse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FreeCourse
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
