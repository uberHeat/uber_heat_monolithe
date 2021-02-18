<?php

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
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $deep;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $height;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $width;

    /**
     * @ORM\OneToOne(targetEntity=Configuration::class, inversedBy="rectangleDim", cascade={"persist", "remove"})
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
        return $this->Configuration;
    }

    public function setConfiguration(?Configuration $Configuration): self
    {
        $this->Configuration = $Configuration;

        return $this;
    }
}
