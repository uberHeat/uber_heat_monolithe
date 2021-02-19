<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CircularDimRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CircularDimRepository::class)
 */
class CircularDim extends Dimension
{

    /**
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     * @Groups({"configurationWrite"})
     */
    private ?float $diameter;


    public function __construct()
    {
        parent::__construct()
        $this->diameter = null;
    }

    public function getDiameter(): ?float
    {
        return $this->diameter;
    }

    public function setDiameter(float $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }

    public function getM2(): ?float
    {
        return math((($this->diameter / 2 )^2) * 3.14);
    }
}
