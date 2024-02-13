<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $traductions = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTraductions(): array
    {
        return $this->traductions;
    }

    public function setTraductions(array $traductions): static
    {
        $this->traductions = $traductions;

        return $this;
    }
}
