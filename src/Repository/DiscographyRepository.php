<?php

namespace App\Repository;

use App\Entity\Discography;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Discography>
 *
 * @method Discography|null find($id, $lockMode = null, $lockVersion = null)
 * @method Discography|null findOneBy(array $criteria, array $orderBy = null)
 * @method Discography[]    findAll()
 * @method Discography[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscographyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Discography::class);
    }

//    /**
//     * @return Discography[] Returns an array of Discography objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Discography
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
