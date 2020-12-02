<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    // queryBuilder
    public function findAllJoinGenre()
    {
        return $this->createQueryBuilder('l')
            ->select(['l', 'g', 'a'])
            ->leftJoin('l.genre', 'g')
            ->leftJoin('l.auteurs', 'a')
            ->orderBy('l.id')
            ->getQuery()
            ->getResult();
    }

    public function findOneJoinGenre($id): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->select(['l', 'g'])
            ->leftJoin('l.genre', 'g')
            ->where('l.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
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
    public function findOneBySomeField($value): ?Livre
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
