<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    
   

    #[ORM\Column(type: 'integer', unique: true)]
    private ?int $id_etudiant = null;

    #[ORM\Column(type: 'string', length: 80)]
    private ?string $nom_Etd = null;

    #[ORM\Column(type: 'string', length: 90)]
    private ?string $prenom_Etd = null;

    #[ORM\Column(type: 'integer')]
    private ?int $age = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEtudiant(): ?int
    {
        return $this->id_etudiant;
    }

    public function setIdEtudiant(int $id_etudiant): static
    {
        $this->id_etudiant = $id_etudiant;

        return $this;
    }

    public function getNomEtd(): ?string
    {
        return $this->nom_Etd;
    }

    public function setNomEtd(string $prenom_Etd): static
    {
        $this->nom_Etd = $nom_Etd;

        return $this;
    }

    public function getPrenomEtd(): ?string
    {
        return $this->prenom_Etd;
    }

    public function setPrenomEtd(string $prenom_Etd): static
    {
        $this->prenom_Etd = $prenom_Etd;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }


}
