<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ConfigurationRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Dto\ConfigurationInput;
use App\Dto\ConfigurationOutput;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ConfigurationRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *         "create"={
 *             "method"="POST",
 *             "input"=ConfigurationInput::class,
 *             "denormalization_context"={"groups"={"configurationWrite"}}
 *         }
 *     },
 * )
 */
class Configuration
{
    use ResourceId;
    use Timestamps;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="configurations")
     */
    private ?Product $product;

    /**
     * @ORM\OneToOne(targetEntity="Dimension", mappedBy="config", cascade={"persist","remove"})
     * @Groups({"configurationWrite"})
     */
    private ?Dimension $dimension;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->dimension = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getDimension(): ?Dimension
    {
        return $this->dimension;
    }

    public function setDimension(Dimension $dimension): self
    {
        $this->dimension = $dimension;

        return $this;
    }

}
