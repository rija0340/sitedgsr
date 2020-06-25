<?php

namespace App\Repository;

use App\Entity\Faritany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Faritany|null find($id, $lockMode = null, $lockVersion = null)
 * @method Faritany|null findOneBy(array $criteria, array $orderBy = null)
 * @method Faritany[]    findAll()
 * @method Faritany[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FaritanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Faritany::class);
    }

    // /**
    //  * @return Faritany[] Returns an array of Faritany objects
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
    public function findOneBySomeField($value): ?Faritany
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
