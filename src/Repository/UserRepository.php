<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
*/
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function findLastest() 
    {
        return $this->createQueryBuilder('a')
        // ->orderBy('p.id', 'ASC')
           // ->andWhere('a.createdAt > :date')
           // ->setParameter('date', (new \DateTime('-30 day')))
            ->select('a as artiste')
            ->addSelect('count(e.id) as val')
            ->join('a.events','e')
            ->groupBy('a.id')
        //  $this->findVisibleQuery()
        //            // ->setMaxResults(4)
                ->getQuery()
               //->getDQL();
                  ->getResult();
                    
    }

    public function findVisible() 
    {
        return $this->createQueryBuilder('a')
                    ->select('a as user')
                    ->addSelect('count(e.id) as val')
                    ->join('a.events','e')
                    ->groupBy('a.id')
                    ->setMaxResults(4)
                    ->getQuery()

                    //->andWhere('p.createdAt > :date')
                    //->setParameter('date', (new \DateTime('-30 day')))
                    ->getResult();
        ;
    }
   
    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
