<?php

namespace App\Entity;

use App\Repository\EquipementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementsRepository::class)]
class Equipements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToMany(targetEntity: SallesTravail::class, inversedBy: 'equipements')]
    private Collection $sallesTravail;

    #[ORM\Column]
    private ?bool $wifi_equipement = null;

    #[ORM\Column]
    private ?bool $projecteur_equipement = null;

    #[ORM\Column]
    private ?bool $tableau_equipement = null;

    #[ORM\Column]
    private ?bool $priseElectrique_equipement = null;

    #[ORM\Column]
    private ?bool $television_equipement = null;

    #[ORM\Column]
    private ?bool $climatisation_equipement = null;

    public function __construct()
    {
        $this->sallesTravail = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, SallesTravail>
     */
    public function getSallesTravail(): Collection
    {
        return $this->sallesTravail;
    }

    public function addSallesTravail(SallesTravail $sallesTravail): static
    {
        if (!$this->sallesTravail->contains($sallesTravail)) {
            $this->sallesTravail->add($sallesTravail);
        }

        return $this;
    }

    public function removeSallesTravail(SallesTravail $sallesTravail): static
    {
        $this->sallesTravail->removeElement($sallesTravail);

        return $this;
    }

    public function isWifiEquipement(): ?bool
    {
        return $this->wifi_equipement;
    }

    public function setWifiEquipement(bool $wifi_equipement): static
    {
        $this->wifi_equipement = $wifi_equipement;

        return $this;
    }

    public function isProjecteurEquipement(): ?bool
    {
        return $this->projecteur_equipement;
    }

    public function setProjecteurEquipement(bool $projecteur_equipement): static
    {
        $this->projecteur_equipement = $projecteur_equipement;

        return $this;
    }

    public function isTableauEquipement(): ?bool
    {
        return $this->tableau_equipement;
    }

    public function setTableauEquipement(bool $tableau_equipement): static
    {
        $this->tableau_equipement = $tableau_equipement;

        return $this;
    }

    public function isPriseElectriqueEquipement(): ?bool
    {
        return $this->priseElectrique_equipement;
    }

    public function setPriseElectriqueEquipement(bool $priseElectrique_equipement): static
    {
        $this->priseElectrique_equipement = $priseElectrique_equipement;

        return $this;
    }

    public function isTelevisionEquipement(): ?bool
    {
        return $this->television_equipement;
    }

    public function setTelevisionEquipement(bool $television_equipement): static
    {
        $this->television_equipement = $television_equipement;

        return $this;
    }

    public function isClimatisationEquipement(): ?bool
    {
        return $this->climatisation_equipement;
    }

    public function setClimatisationEquipement(bool $climatisation_equipement): static
    {
        $this->climatisation_equipement = $climatisation_equipement;

        return $this;
    }
}
