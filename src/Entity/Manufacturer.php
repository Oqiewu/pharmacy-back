<?php

namespace App\Entity;

use App\Repository\ManufacturerRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Serializer\Annotation\SerializedName;


#[ORM\Entity(repositoryClass: ManufacturerRepository::class)]
class Manufacturer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $manufacture_name;

    #[ORM\ManyToMany(targetEntity: Provider::class, inversedBy: 'provider')]
    private $provider;

    public function __construct()
    {
        $this->provider = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManufactureName(): ?string
    {
        return $this->manufacture_name;
    }

    public function setManufactureName(string $manufacture_name): static
    {
        $this->manufacture_name = $manufacture_name;

        return $this;
    }

    public function getProvider(): ?PersistentCollection
    {
        return $this->provider;
    }

    public function setProvider(PersistentCollection $provider): static
    {
        $this->provider = $provider;

        return $this;
    }

    
    public function addProvider(Provider $provider): static
    {
        if (!$this->provider->contains($provider)) {
            $this->provider->add($provider);
        }

        return $this;
    }

    public function removeProvider(Provider $provider): static
    {
        $this->provider->removeElement($provider);

        return $this;
    }
}