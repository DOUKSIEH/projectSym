<?php

namespace App\Repository;

use App\Entity\LignedeCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LignedeCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method LignedeCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method LignedeCommande[]    findAll()
 * @method LignedeCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LignedeCommandeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LignedeCommande::class);
    }

    // /**
    //  * @return LignedeCommande[] Returns an array of LignedeCommande objects
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
    public function findOneBySomeField($value): ?LignedeCommande
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
