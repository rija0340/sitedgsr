<?php

namespace App\Repository;

use App\Entity\LabelCouverture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LabelCouverture|null find($id, $lockMode = null, $lockVersion = null)
 * @method LabelCouverture|null findOneBy(array $criteria, array $orderBy = null)
 * @method LabelCouverture[]    findAll()
 * @method LabelCouverture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LabelCouvertureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LabelCouverture::class);
    }

    // /**
    //  * @return LabelCouverture[] Returns an array of LabelCouverture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LabelCouverture
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
