<?php

namespace App\Repository;

use App\Entity\TQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TQuestion[]    findAll()
 * @method TQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TQuestion::class);
    }

    // /**
    //  * @return TQuestion[] Returns an array of TQuestion objects
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
    public function findOneBySomeField($value): ?TQuestion
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
