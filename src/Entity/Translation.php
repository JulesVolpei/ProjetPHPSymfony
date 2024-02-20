<?php

namespace App\Entity;

use App\Repository\TranslationRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManagerInterface;

#[ORM\Entity(repositoryClass: TranslationRepository::class)]
class Translation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_translation = null;

    #[ORM\Column]
    private ?int $id_object = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    public ?EntityManagerInterface $entityManager = null;

    public function __construct(?int $id = null, EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTranslation(): ?int
    {
        return $this->id_translation;
    }

    public function setIdTranslation(int $id_translation): static
    {
        $this->id_translation = $id_translation;

        return $this;
    }

    public function getIdObject(): ?int
    {
        return $this->id_object;
    }

    public function setIdObject(int $id_object): static
    {
        $this->id_object = $id_object;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public static function getTranslationByObjectId(int $id_object, $entityManager) : array
    {
        $translations = [];
        $query = $entityManager->createQuery(
            'SELECT t.content
            FROM '. strtolower(self::class) .' t
            WHERE t.id_object = '.$id_object
        );

        foreach($query->getResult() as $row){
            $translations[] = $row['content'];
        }
        
        return $translations;
    }
}
