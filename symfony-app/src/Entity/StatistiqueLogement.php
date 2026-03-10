<?php

namespace App\Entity;

use App\Repository\StatistiqueLogementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatistiqueLogementRepository::class)]
#[ORM\Table(name: 'statistique_logement')]
class StatistiqueLogement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'float')]
    private ?float $construction = null;

    #[ORM\Column(type: 'integer')]
    private ?int $nombreLogement = null;

    #[ORM\ManyToOne(targetEntity: Departement::class)]
    #[ORM\JoinColumn(name: 'departement_id', referencedColumnName: 'id', nullable: false)]
    private ?Departement $departement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConstruction(): ?float
    {
        return $this->construction;
    }

    public function setConstruction(float $construction): static
    {
        $this->construction = $construction;
        return $this;
    }

    public function getNombreLogement(): ?int
    {
        return $this->nombreLogement;
    }

    public function setNombreLogement(int $nombreLogement): static
    {
        $this->nombreLogement = $nombreLogement;
        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): static
    {
        $this->departement = $departement;
        return $this;
    }
}

