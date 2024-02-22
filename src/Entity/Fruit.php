<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public $entityManager;

    public function __construct(int $id = null, EntityManagerInterface $entityManager)
    {
        $this->id = $id;
        $this->entityManager = $entityManager;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTranslations(){
        return FruitRepository::getTraductions($this);
    }

    public static function getRandomId(FruitRepository $fruitRepository):int{
        $fruitRepository->getRandomFruit();
        return 0;
    }
}
