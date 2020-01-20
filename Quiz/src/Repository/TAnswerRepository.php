<?php

namespace App\Repository;

use App\Entity\TAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method TAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method TAnswer[]    findAll()
 * @method TAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TAnswer::class);
    }

    // /**
    //  * @return TAnswer[] Returns an array of TAnswer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TAnswer
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
