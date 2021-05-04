<?php

namespace App\Repository;

use App\Entity\Reponsehistorique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reponsehistorique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reponsehistorique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reponsehistorique[]    findAll()
 * @method Reponsehistorique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReponsehistoriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reponsehistorique::class);
    }

    // /**
    //  * @return Reponsehistorique[] Returns an array of Reponsehistorique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reponsehistorique
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
