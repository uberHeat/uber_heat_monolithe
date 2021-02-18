<?php

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
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $deep;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $diameter;

    /**
     * @ORM\OneToOne(targetEntity=Configuration::class, inversedBy="circularDim", cascade={"persist", "remove"})
     */
    private $Configuration;

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
        return $this->Configuration;
    }

    public function setConfiguration(?Configuration $Configuration): self
    {
        $this->Configuration = $Configuration;

        return $this;
    }
}
