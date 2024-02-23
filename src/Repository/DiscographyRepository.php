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

    public function trouverLesReleases($userId): array
    {
        return $this->createQueryBuilder('d')
            ->select('DISTINCT d.idRelease')
            ->where('d.id_user = :userId')
            ->setParameter('userId', $userId)
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

    /*TODO: - Faire la requête pour avoir la discogrphy d'un utilisateur ✅
            - Faire en sorte que le bouton ajoute l'idRelease à l'utilisateur dans la table discography ✅
            - Passer dans le controller le résultat (refaire la requête vers discogs avec les idReleases)
    */

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
