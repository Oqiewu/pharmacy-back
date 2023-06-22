<?php

namespace App\Entity;

use App\Repository\ActiveSubstanceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActiveSubstanceRepository::class)]
class ActiveSubstance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $substance_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubstanceName(): ?string
    {
        return $this->substance_name;
    }

    public function setSubstanceName(string $substance_name): static
    {
        $this->substance_name = $substance_name;

        return $this;
    }
}
