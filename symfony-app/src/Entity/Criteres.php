<?php

namespace App\Entity;

use App\Repository\CriteresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CriteresRepository::class)]
#[ORM\Table(name: 'criteres')]
class Criteres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private ?int $anneeDePublication = null;

    #[ORM\Column(type: 'integer')]
    private ?int $nombreDHabitants = null;

    #[ORM\Column(type: 'float')]
    private ?float $densiteDePopulation = null;

    #[ORM\Column(type: 'float')]
    private ?float $variationPopulation10Ans = null;

    #[ORM\Column(type: 'float')]
    private ?float $tauxDeChomage = null;

    #[ORM\Column(type: 'float')]
    private ?float $tauxDePauvrete = null;

    #[ORM\Column(type: 'float')]
    private ?float $tauxDeLogementsSociaux = null;

    #[ORM\Column(type: 'float')]
    private ?float $tauxDeLogementsVacants = null;

    #[ORM\ManyToOne(targetEntity: Departement::class, inversedBy: 'criteres')]
    #[ORM\JoinColumn(name: 'departement_id', referencedColumnName: 'id', nullable: false)]
    private ?Departement $departement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeDePublication(): ?int
    {
        return $this->anneeDePublication;
    }

    public function setAnneeDePublication(int $anneeDePublication): static
    {
        $this->anneeDePublication = $anneeDePublication;
        return $this;
    }

    public function getNombreDHabitants(): ?int
    {
        return $this->nombreDHabitants;
    }

    public function setNombreDHabitants(int $nombreDHabitants): static
    {
        $this->nombreDHabitants = $nombreDHabitants;
        return $this;
    }

    public function getDensiteDePopulation(): ?float
    {
        return $this->densiteDePopulation;
    }

    public function setDensiteDePopulation(float $densiteDePopulation): static
    {
        $this->densiteDePopulation = $densiteDePopulation;
        return $this;
    }

    public function getVariationPopulation10Ans(): ?float
    {
        return $this->variationPopulation10Ans;
    }

    public function setVariationPopulation10Ans(float $variationPopulation10Ans): static
    {
        $this->variationPopulation10Ans = $variationPopulation10Ans;
        return $this;
    }

    public function getTauxDeChomage(): ?float
    {
        return $this->tauxDeChomage;
    }

    public function setTauxDeChomage(float $tauxDeChomage): static
    {
        $this->tauxDeChomage = $tauxDeChomage;
        return $this;
    }

    public function getTauxDePauvrete(): ?float
    {
        return $this->tauxDePauvrete;
    }

    public function setTauxDePauvrete(float $tauxDePauvrete): static
    {
        $this->tauxDePauvrete = $tauxDePauvrete;
        return $this;
    }

    public function getTauxDeLogementsSociaux(): ?float
    {
        return $this->tauxDeLogementsSociaux;
    }

    public function setTauxDeLogementsSociaux(float $tauxDeLogementsSociaux): static
    {
        $this->tauxDeLogementsSociaux = $tauxDeLogementsSociaux;
        return $this;
    }

    public function getTauxDeLogementsVacants(): ?float
    {
        return $this->tauxDeLogementsVacants;
    }

    public function setTauxDeLogementsVacants(float $tauxDeLogementsVacants): static
    {
        $this->tauxDeLogementsVacants = $tauxDeLogementsVacants;
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

