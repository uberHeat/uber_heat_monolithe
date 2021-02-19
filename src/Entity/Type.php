<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 * @ApiResource(
 *   collectionOperations={
 *      "get",
 *      "post"={
 *        "denormalization_context"={"groups"={"typeWrite"}}
 *      },
 *   },
 *   itemOperations={
 *     "get",
 *     "put"={
 *        "denormalization_context"={"groups"={"typeWrite"}}
 *      },
 *     "patch"={
 *        "denormalization_context"={"groups"={"typeWrite"}}
 *      },
 *     "delete",
 *   }
 * )
 */
class Type
{
    use ResourceId;
    use Timestamps;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"typeWrite"})
     */
    private string $code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"typeWrite"})
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity=Configuration::class, mappedBy="type")
     */
    private Collection $configurations;

    public function __construct()
    {
        $this->configurations = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $configuration->setType($this);
        }

        return $this;
    }

    public function removeConfiguration(Configuration $configuration): self
    {
        if ($this->configurations->removeElement($configuration)) {
            // set the owning side to null (unless already changed)
            if ($configuration->getType() === $this) {
                $configuration->setType(null);
            }
        }

        return $this;
    }
}
