<?php

namespace App\Repository;

use App\Entity\PendingRequestGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PendingRequestGame|null find($id, $lockMode = null, $lockVersion = null)
 * @method PendingRequestGame|null findOneBy(array $criteria, array $orderBy = null)
 * @method PendingRequestGame[]    findAll()
 * @method PendingRequestGame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PendingRequestGameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PendingRequestGame::class);
    }

    // /**
    //  * @return PendingRequestGame[] Returns an array of PendingRequestGame objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PendingRequestGame
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
