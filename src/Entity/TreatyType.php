<?php

namespace App\Entity;

use App\Repository\TreatyTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TreatyTypeRepository::class)]
class TreatyType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $treaty_type_name = null;

    #[ORM\ManyToOne(targetEntity: Treaty::class, inversedBy: 'treaty_type')]
    private $treaty;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTreatyTypeName(): ?string
    {
        return $this->treaty_type_name;
    }

    public function setTreatyTypeName(string $treaty_type_name): static
    {
        $this->treaty_type_name = $treaty_type_name;

        return $this;
    }

    public function getTreaty(): ?Treaty
    {
        return $this->treaty;
    }

    public function setTreaty(?Treaty $treaty): static
    {
        $this->treaty = $treaty;

        return $this;
    }
}
