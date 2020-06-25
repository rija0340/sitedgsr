<?php

namespace App\Repository;

use App\Entity\DgWord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DgWord|null find($id, $lockMode = null, $lockVersion = null)
 * @method DgWord|null findOneBy(array $criteria, array $orderBy = null)
 * @method DgWord[]    findAll()
 * @method DgWord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DgWordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DgWord::class);
    }

    // /**
    //  * @return DgWord[] Returns an array of DgWord objects
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
    public function findOneBySomeField($value): ?DgWord
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
