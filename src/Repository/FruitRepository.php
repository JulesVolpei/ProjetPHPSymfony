<?php

namespace App\Repository;

use App\Entity\Fruit;
use App\Entity\Translation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fruit>
 *
 * @method Fruit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fruit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fruit[]    findAll()
 * @method Fruit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FruitRepository extends ServiceEntityRepository
{

    public ?EntityManager $entityManager = null; 

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fruit::class);
    }

    public static function getTraductions(Fruit $fruit): array
    {
        return Translation::getTranslationByObjectId($fruit->getId(), $fruit->entityManager);
    }


    public function save(Fruit $fruit,array $traductions = [], ?int $id_fruit = null) : void {
        if (count($traductions) > 0) {
            if(is_null($id_fruit)){
                $id_fruit = $fruit->getId();
            }
            $this->setTraductions($traductions,$id_fruit);
        }
        $this->entityManager->persist($fruit);
        $this->entityManager->flush();

    }

    public function getRandomFruit() : int{
        $fruits = $this->findAll();
        $return = array_rand($fruits) + 1;
        return $return;
    }
}
