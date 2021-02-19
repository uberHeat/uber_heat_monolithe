<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\RectangleDimRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RectangleDimRepository::class)
 * @ApiResource()
 */
class RectangleDim extends Dimension
{

    /**
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     * @Groups({"configurationWrite"})
     */
    private ?float $height;

    /**
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     * @Groups({"configurationWrite"})
     */
    private ?float $width;

    public function __construct()
    {
        parent::__construct();
        $this->height = null;
        $this->width = null;

    }

    public function getM2(): ?float
    {
        return $this->height * $this->width;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }
}
