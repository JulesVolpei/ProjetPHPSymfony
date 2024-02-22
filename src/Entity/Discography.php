<?php

namespace App\Entity;

use App\Repository\DiscographyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiscographyRepository::class)]
class Discography
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_user = null;

    #[ORM\Column]
    private ?int $idRelease = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdRelease(): ?int
    {
        return $this->idRelease;
    }

    public function setIdRelease(int $idRelease): static
    {
        $this->idRelease = $idRelease;

        return $this;
    }
}
