<?php

namespace App\Repository;

use App\Entity\Organigramme;
use App\Repository\findVisibleQuery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;


/**
 * @method Organigramme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Organigramme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Organigramme[]    findAll()
 * @method Organigramme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganigrammeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Organigramme::class);
    }

     /**
     * @return Organigramme[]
     */
     public function findLatest() : array {
        return $this->findVisibleQuery()
        ->setMaxResults(1)
        ->getQuery()
        ->getResult();
    }

    
    private function findVisibleQuery( ): QueryBuilder{
        return $this->createQueryBuilder('p');
    }
    // /**
    //  * @return Organigramme[] Returns an array of Organigramme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Organigramme
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
