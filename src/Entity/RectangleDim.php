<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\RectangleDimRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RectangleDimRepository::class)
 */
class RectangleDim extends Dimension
{

    /**
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     * @Groups({"configurationWrite"})
     */
    private float $height;

    /**
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     * @Groups({"configurationWrite"})
     */
    private float $width;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->configuration = null;
        $this->width = null;
        $this->deep = null;
        $this->height = null;
    }

    public function getM2(): ?float
    {
        return math($this->height * $this->width);
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
}
