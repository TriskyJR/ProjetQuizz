<?php

namespace App\Repository;

use App\Entity\TUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method TUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method TUser[]    findAll()
 * @method TUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TUser::class);
    }

    // /**
    //  * @return TUser[] Returns an array of TUser objects
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
    public function findOneBySomeField($value): ?TUser
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
