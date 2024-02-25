<?php

namespace App\Repository;

use App\Entity\Discography;
use App\Entity\DiscographyInfos;
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

    public function trouverLesReleases($userId): array {
        return $this->createQueryBuilder('d')
            ->select('d.idRelease')
            ->where('d.id_user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }

    public function verifieSiUserADejaLeRelease($userId, $idRelease): array {
        return $this->createQueryBuilder('d')
        ->select('d')
        ->where('d.id_user = :userId AND d.idRelease = :idRelease')
        ->setParameter('userId', $userId)
        ->setParameter('idRelease', $idRelease)
        ->getQuery()
        ->getResult();
    }

    public function ajouterReleaseAUser($userId, $releaseId)
    {
   
        $discography = new Discography();

        $discography->setIdUser($userId);
        $discography->setIdRelease($releaseId);

        $entityManager = $this->getEntityManager();
        $entityManager->persist($discography);
        $entityManager->flush();
    }

    public function retrouveInfosDiscography($idRelease): array {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQueryBuilder()
        ->select('di.releaseTitre, di.image')
        ->from('App\Entity\DiscographyInfos', 'di')
        ->where('di.idRelease = :releaseId')
        ->setParameter('releaseId', $idRelease)
        ->getQuery();

        $result = $query->getResult();

        return $result;
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
