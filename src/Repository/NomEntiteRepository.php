<?php

namespace App\Repository;

use App\Entity\NomEntite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NomEntite|null find($id, $lockMode = null, $lockVersion = null)
 * @method NomEntite|null findOneBy(array $criteria, array $orderBy = null)
 * @method NomEntite[]    findAll()
 * @method NomEntite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NomEntiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NomEntite::class);
    }

    // /**
    //  * @return NomEntite[] Returns an array of NomEntite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NomEntite
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
