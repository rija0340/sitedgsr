<?php

namespace App\Repository;

use App\Entity\DG;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DG|null find($id, $lockMode = null, $lockVersion = null)
 * @method DG|null findOneBy(array $criteria, array $orderBy = null)
 * @method DG[]    findAll()
 * @method DG[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DGRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DG::class);
    }

    // /**
    //  * @return DG[] Returns an array of DG objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DG
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
