<?php

namespace App\Entity;

use App\Repository\ConfigurationRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConfigurationRepository::class)
 * @ApiResource()
 */
class Configuration
{
    use ResourceId;
    use Timestamps;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="configurations")
     */
    private Product $product;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
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
}
