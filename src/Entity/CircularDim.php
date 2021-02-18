<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CircularDimRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CircularDimRepository::class)
 */
class CircularDim
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
    private ?string $diameter;

    /**
     * @ORM\OneToOne(targetEntity=Configuration::class, inversedBy="circularDim", cascade={"persist", "remove"})
     */
    private ?Configuration $configuration;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->deep = null;
        $this->diameter = null;
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

    public function getDiameter(): ?string
    {
        return $this->diameter;
    }

    public function setDiameter(string $diameter): self
    {
        $this->diameter = $diameter;

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
