<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\RectangleDimRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RectangleDimRepository::class)
 */
class RectangleDim
{
    use ResourceId;
    use Timestamps;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?string $deep;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?string $height;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?string $width;

    /**
     * @ORM\OneToOne(targetEntity=Configuration::class, inversedBy="rectangleDim", cascade={"persist", "remove"})
     */
    private ?Configuration $configuration;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->configuration = null;
        $this->width = null;
        $this->deep = null;
        $this->height = null;
    }

    public function getDeep(): ?string
    {
        return $this->deep;
    }

    public function setDeep(string $deep): self
    {
        $this->deep = $deep;

        return $this;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(string $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?string
    {
        return $this->width;
    }

    public function setWidth(string $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getConfiguration(): ?Configuration
    {
        return $this->configuration;
    }

    public function setConfiguration(?Configuration $configuration): self
    {
        $this->configuration = $configuration;

        return $this;
    }
}
