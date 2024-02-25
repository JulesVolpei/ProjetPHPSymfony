<?php

namespace App\Entity;

use App\Repository\DiscographyInfosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiscographyInfosRepository::class)]
class DiscographyInfos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $idRelease = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $releaseTitre = null;

    #[ORM\Column(length: 800, nullable: true)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRelease(): ?int
    {
        return $this->idRelease;
    }

    public function setIdRelease(?int $idRelease): static
    {
        $this->idRelease = $idRelease;

        return $this;
    }

    public function getReleaseTitre(): ?string
    {
        return $this->releaseTitre;
    }

    public function setReleaseTitre(?string $releaseTitre): static
    {
        $this->releaseTitre = $releaseTitre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
