<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"circle" = "CircularDim", "rectangle" = "RectangleDim"})
 */
abstract class Dimension
{
    use ResourceId;

    /**
     * @ORM\OneToOne(targetEntity="Configuration", inversedBy="dimension")
     * @ORM\JoinColumn(name="config_id", referencedColumnName="id")
     */
    protected ?Configuration $config;

    /**
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     * @Groups({"configurationWrite"})
     */
    protected ?float $deep;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->config = null;
        $this->deep = null;
    }

    public function getDeep(): ?float
    {
        return $this->deep;
    }

    public function setDeep(float $deep): self
    {
        $this->deep = $deep;

        return $this;
    }

    public function getConfig(): ?Configuration
    {
        return $this->config;
    }

    public function setConfig(Configuration $config): self
    {
        $this->config = $config;

        return $this;
    }
}
