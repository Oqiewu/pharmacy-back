<?php

namespace App\Entity;

use App\Repository\ClientTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientTypeRepository::class)]
class ClientType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $client_type_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientTypeName(): ?string
    {
        return $this->client_type_name;
    }

    public function setClientTypeName(string $client_type_name): static
    {
        $this->client_type_name = $client_type_name;

        return $this;
    }
}
