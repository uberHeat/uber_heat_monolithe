<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ConfigurationRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Dto\ConfigurationInput;
use App\Dto\ConfigurationOutput;

/**
 * @ORM\Entity(repositoryClass=ConfigurationRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *         "create"={
 *             "method"="POST",
 *             "input"=ConfigurationInput::class
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
     * @ORM\OneToOne(targetEntity=CircularDim::class, mappedBy="configuration", cascade={"persist", "remove"})
     */
    public ?CircularDim $circularDim;

    /**
     * @ORM\OneToOne(targetEntity=RectangleDim::class, mappedBy="configuration", cascade={"persist", "remove"})
     */
    public ?RectangleDim $rectangleDim;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->rectangleDim = new RectangleDim();
        $this->circularDim = new CircularDim();
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

    public function getCircularDim(): ?CircularDim
    {
        return $this->circularDim;
    }

    public function setCircularDim(?CircularDim $circularDim): self
    {
        // unset the owning side of the relation if necessary
        if ($circularDim === null && $this->circularDim !== null) {
            $this->circularDim->setConfiguration(null);
        }

        // set the owning side of the relation if necessary
        if ($circularDim !== null && $circularDim->getConfiguration() !== $this) {
            $circularDim->setConfiguration($this);
        }

        $this->circularDim = $circularDim;

        return $this;
    }

    public function getRectangleDim(): ?RectangleDim
    {
        return $this->rectangleDim;
    }

    public function setRectangleDim(?RectangleDim $rectangleDim): self
    {
        // unset the owning side of the relation if necessary
        if ($rectangleDim === null && $this->rectangleDim !== null) {
            $this->rectangleDim->setConfiguration(null);
        }

        // set the owning side of the relation if necessary
        if ($rectangleDim !== null && $rectangleDim->getConfiguration() !== $this) {
            $rectangleDim->setConfiguration($this);
        }

        $this->rectangleDim = $rectangleDim;

        return $this;
    }
}
