<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\User\UserCurrent;
use App\Controller\User\UserDismiss;
use App\Controller\User\UserGrant;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ApiResource(
 *   collectionOperations={
 *      "get"={
 *        "normalization_context"={"groups"={"userRead", "alwaysDisplay"}},
 *      },
 *      "post"={
 *        "denormalization_context"={"groups"={"userWrite"}}
 *      },
       "current_user"={
 *       "normalization_context"={"groups"={"userDetailRead", "alwaysDisplay"}},
 *       "method"="GET",
 *       "path"="/custom/users/current",
 *       "controller"=UserCurrent::class,
 *     },
 *   },
 *   itemOperations={
 *     "get"={
 *        "normalization_context"={"groups"={"userDetailRead", "alwaysDisplay"}}
 *      },
 *     "put"={
 *        "denormalization_context"={"groups"={"userWrite"}},
 *        "security"="is_granted('ROLE_ADMIN') or object == user"
 *      },
 *     "patch"={
 *        "denormalization_context"={"groups"={"userWrite"}},
 *        "security"="is_granted('ROLE_ADMIN') or object == user"
 *      },
 *     "delete"={"security"="is_granted('ROLE_ADMIN') or object == user"},
 *     "grant"={
 *       "normalization_context"={"groups"={"userRead", "alwaysDisplay"}},
 *       "method"="GET",
 *       "path"="/custom/users/{id}/grant",
 *       "controller"=UserGrant::class
 *    },
 *     "dismiss"={
 *       "normalization_context"={"groups"={"userRead", "alwaysDisplay"}},
 *       "method"="GET",
 *       "path"="/custom/users/{id}/dismiss",
 *       "controller"=UserDismiss::class,
 *       "security"="is_granted('ROLE_ADMIN')"
 *     }
 *   }
 * )
 * @UniqueEntity("email", message="This email is already used")
 *
 * @ApiFilter(SearchFilter::class, properties={"email": "partial"})
 * @ApiFilter(DateFilter::class, properties={"createdAt"})
 * @ApiFilter(ExistsFilter::class, properties={"updatedAt"})
 * @ApiFilter(OrderFilter::class, properties={"id","createdAt","updatedAt"}, arguments={"orderParameterName"="order"})
 */
class User implements UserInterface
{
    use ResourceId;
    use Timestamps;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"userRead","userDetailRead", "userWrite"})
     * @Assert\NotBlank(message="email required")
     * @Assert\Email(message="format invalid")
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"userRead","userDetailRead"})
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"userWrite"})
     * @Assert\NotBlank(message="password required")
     */
    private string $password;

    /**
     * @ORM\ManyToMany(targetEntity=Animation::class, mappedBy="users", cascade={"persist"})
     * @Groups({"userRead", "userDetailRead"})
     */
    private Collection $animations;

    public function __construct()
    {
        $this->animations = new ArrayCollection();

        $this->createdAt = new \DateTimeImmutable();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Animation[]
     */
    public function getAnimations(): Collection
    {
        return $this->animations;
    }

    public function addAnimation(Animation $animation): self
    {
        if (!$this->animations->contains($animation)) {
            $this->animations[] = $animation;
            $animation->addUser($this);
        }

        return $this;
    }

    public function removeAnimation(Animation $animation): self
    {
        if ($this->animations->removeElement($animation)) {
            $animation->removeUser($this);
        }

        return $this;
    }
}
