<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(length: 30)]
    private ?string $username = null;

    #[ORM\Column(length: 40)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $phone = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $website = null;

    /**
     * @var Collection<int, Address>
     */
    #[ORM\OneToMany(targetEntity: Address::class, mappedBy: 'user')]
    private Collection $addressId;

    /**
     * @var Collection<int, Company>
     */
    #[ORM\OneToMany(targetEntity: Company::class, mappedBy: 'user')]
    private Collection $companyId;

    /**
     * @var Collection<int, Post>
     */
    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'userId')]
    private Collection $posts;

    public function __construct()
    {
        $this->addressId = new ArrayCollection();
        $this->companyId = new ArrayCollection();
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): static
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAddressId(): Collection
    {
        return $this->addressId;
    }

    public function addAddressId(Address $addressId): static
    {
        if (!$this->addressId->contains($addressId)) {
            $this->addressId->add($addressId);
            $addressId->setUser($this);
        }

        return $this;
    }

    public function removeAddressId(Address $addressId): static
    {
        if ($this->addressId->removeElement($addressId)) {
            // set the owning side to null (unless already changed)
            if ($addressId->getUser() === $this) {
                $addressId->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Company>
     */
    public function getCompanyId(): Collection
    {
        return $this->companyId;
    }

    public function addCompanyId(Company $companyId): static
    {
        if (!$this->companyId->contains($companyId)) {
            $this->companyId->add($companyId);
            $companyId->setUser($this);
        }

        return $this;
    }

    public function removeCompanyId(Company $companyId): static
    {
        if ($this->companyId->removeElement($companyId)) {
            // set the owning side to null (unless already changed)
            if ($companyId->getUser() === $this) {
                $companyId->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): static
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

        return $this;
    }
}
