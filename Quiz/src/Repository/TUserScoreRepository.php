<?php

namespace App\Repository;

use App\Entity\TUserScore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TUserScore|null find($id, $lockMode = null, $lockVersion = null)
 * @method TUserScore|null findOneBy(array $criteria, array $orderBy = null)
 * @method TUserScore[]    findAll()
 * @method TUserScore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TUserScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TUserScore::class);
    }

    // /**
    //  * @return TUserScore[] Returns an array of TUserScore objects
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
    public function findOneBySomeField($value): ?TUserScore
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
