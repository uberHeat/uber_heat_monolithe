<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\NoiseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;



/**
 * @ORM\Entity(repositoryClass=NoiseRepository::class)
 * @ApiResource(
 *   collectionOperations={
 *      "get",
 *      "post"={
 *        "denormalization_context"={"groups"={"noiseWrite"}}
 *      },
 *   },
 *   itemOperations={
 *     "get",
 *     "put"={
 *        "denormalization_context"={"groups"={"noiseWrite"}}
 *      },
 *     "patch"={
 *        "denormalization_context"={"groups"={"noiseWrite"}}
 *      },
 *     "delete",
 *   }
 * )
 */
class Noise
{

    use ResourceId;
    use Timestamps;

    /**
     * @ORM\Column(type="float")
     * @Groups({"noiseWrite"})
     */
    private float $distance;

    /**
     * @ORM\Column(type="float")
     * @Groups({"noiseWrite"})
     */
    private float $value;

    /**
     * @ORM\ManyToMany(targetEntity=Configuration::class, inversedBy="noises")
     */
    private Collection $configurations;

    public function __construct()
    {
        $this->configurations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection|Configuration[]
     */
    public function getConfigurations(): Collection
    {
        return $this->configurations;
    }

    public function addConfiguration(Configuration $configuration): self
    {
        if (!$this->configurations->contains($configuration)) {
            $this->configurations[] = $configuration;
        }

        return $this;
    }

    public function removeConfiguration(Configuration $configuration): self
    {
        $this->configurations->removeElement($configuration);

        return $this;
    }
}
