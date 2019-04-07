<?php

namespace App\Repository;

use App\Entity\Buys;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Buys|null find($id, $lockMode = null, $lockVersion = null)
 * @method Buys|null findOneBy(array $criteria, array $orderBy = null)
 * @method Buys[]    findAll()
 * @method Buys[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuysRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Buys::class);
    }

    // /**
    //  * @return Buys[] Returns an array of Buys objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Buys
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
