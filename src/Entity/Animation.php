<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnimationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ORM\Entity(repositoryClass=AnimationRepository::class)
 * @ORM\Table(name="`animation`")
 * @ApiResource(
 *   collectionOperations={
 *      "get",
 *      "post"={"security"="is_granted('ROLE_USER')"}
 *   },
 *   itemOperations={
 *     "get",
 *     "put"={"security"="is_granted('ROLE_USER')"},
 *     "patch"={"security"="is_granted('ROLE_USER')"},
 *     "delete"={"security"="is_granted('ROLE_USER')"}
 *   }
 * )
 * @ApiFilter(OrderFilter::class, properties={"id","createdAt","updatedAt"}, arguments={"orderParameterName"="order"})
 */
class Animation
{
    use ResourceId;
    use Timestamps;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"userDetailRead"})
     */
    private string $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"userDetailRead"})
     */
    private string $short_description;

    /**
     * @ORM\Column(type="text")
     * @Groups({"userDetailRead"})
     */
    private string $long_description;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="animations",  cascade={"persist"})
     */
    private Collection $users;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->users = new ArrayCollection();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): self
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->long_description;
    }

    public function setLongDescription(string $long_description): self
    {
        $this->long_description = $long_description;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }
}
