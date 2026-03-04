<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartementRepository::class)]
#[ORM\Table(name: 'departement')]
class Departement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nomDepartement = null;

    #[ORM\ManyToOne(targetEntity: Region::class, inversedBy: 'departements')]
    #[ORM\JoinColumn(name: 'region_id', referencedColumnName: 'id', nullable: false)]
    private ?Region $region = null;

    #[ORM\OneToMany(mappedBy: 'departement', targetEntity: Criteres::class, orphanRemoval: true)]
    private Collection $criteres;

    public function __construct()
    {
        $this->criteres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDepartement(): ?string
    {
        return $this->nomDepartement;
    }

    public function setNomDepartement(string $nomDepartement): static
    {
        $this->nomDepartement = $nomDepartement;
        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): static
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return Collection<int, Criteres>
     */
    public function getCriteres(): Collection
    {
        return $this->criteres;
    }

    public function addCritere(Criteres $critere): static
    {
        if (!$this->criteres->contains($critere)) {
            $this->criteres->add($critere);
            $critere->setDepartement($this);
        }
        return $this;
    }

    public function removeCritere(Criteres $critere): static
    {
        if ($this->criteres->removeElement($critere)) {
            // set the owning side to null (unless already changed)
            if ($critere->getDepartement() === $this) {
                $critere->setDepartement(null);
            }
        }
        return $this;
    }
}

