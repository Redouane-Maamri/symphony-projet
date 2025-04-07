<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateursRepository::class)]
class Utilisateurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    /**
     * @var Collection<int, Crud>
     */
    #[ORM\OneToMany(targetEntity: Crud::class, mappedBy: 'no')]
    private Collection $Crud;

    public function __construct()
    {
        $this->Crud = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Crud>
     */
    public function getCrud(): Collection
    {
        return $this->Crud;
    }

    public function addCrud(Crud $crud): static
    {
        if (!$this->Crud->contains($crud)) {
            $this->Crud->add($crud);
            $crud->setNo($this);
        }

        return $this;
    }

    public function removeCrud(Crud $crud): static
    {
        if ($this->Crud->removeElement($crud)) {
            // set the owning side to null (unless already changed)
            if ($crud->getNo() === $this) {
                $crud->setNo(null);
            }
        }

        return $this;
    }
}
