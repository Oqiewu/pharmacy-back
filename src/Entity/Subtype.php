<?php

namespace App\Entity;

use App\Repository\SubtypeRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Type;

#[ORM\Entity(repositoryClass: SubtypeRepository::class)]
class Subtype
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $subtype_name = null;

    #[ORM\ManyToOne(targetEntity: Type::class, inversedBy: 'type')]
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubtypeName(): ?string
    {
        return $this->subtype_name;
    }

    public function setSubtypeName(string $subtype_name): static
    {
        $this->subtype_name = $subtype_name;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(Type $type): static
    {
        $this->type = $type;

        return $this;
    }
}
