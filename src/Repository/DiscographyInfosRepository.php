<?php

namespace App\Repository;

use App\Entity\DiscographyInfos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DiscographyInfos>
 *
 * @method DiscographyInfos|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiscographyInfos|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiscographyInfos[]    findAll()
 * @method DiscographyInfos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscographyInfosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiscographyInfos::class);
    }

    public function ajouteInfosDiscographie($idRelease, $titre, $url) {
        $infosDiscography = new DiscographyInfos();

        $infosDiscography->setIdRelease($idRelease);
        $infosDiscography->setReleaseTitre($titre);
        $infosDiscography->setImage($url);

        $entityManager = $this->getEntityManager();
        $entityManager->persist($infosDiscography);
        $entityManager->flush();
    }

//    /**
//     * @return DiscographyInfos[] Returns an array of DiscographyInfos objects
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

//    public function findOneBySomeField($value): ?DiscographyInfos
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
