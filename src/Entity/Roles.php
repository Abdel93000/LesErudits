<?php

namespace App\Entity;

use App\Repository\RolesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * @ORM\Entity(repositoryClass=RolesRepository::class)
 */
class Roles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="roles")
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    // public function __toString()
    // {
    //     return $this->roles;
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(User $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
            $role->setRoles($this);
        }

        return $this;
    }

    public function removeRole(User $role): self
    {
        if ($this->roles->removeElement($role)) {
            // set the owning side to null (unless already changed)
            if ($role->getRoles() === $this) {
                $role->setRoles(null);
            }
        }

        return $this;
    }
}
