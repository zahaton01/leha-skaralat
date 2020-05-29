<?php

namespace App\Repository;

use App\Entity\CallBack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CallBack|null find($id, $lockMode = null, $lockVersion = null)
 * @method CallBack|null findOneBy(array $criteria, array $orderBy = null)
 * @method CallBack[]    findAll()
 * @method CallBack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CallBackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CallBack::class);
    }

    // /**
    //  * @return CallBack[] Returns an array of CallBack objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CallBack
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
