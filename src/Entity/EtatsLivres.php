<?php

namespace App\Entity;

use App\Repository\EtatsLivresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatsLivresRepository::class)]
class EtatsLivres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(targetEntity: Livres::class, mappedBy: 'etatsLivres')]
    private Collection $livres;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
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
     * @return Collection<int, Livres>
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livres $livre): static
    {
        if (!$this->livres->contains($livre)) {
            $this->livres->add($livre);
            $livre->setEtatsLivres($this);
        }

        return $this;
    }

    public function removeLivre(Livres $livre): static
    {
        // set the owning side to null (unless already changed)
        if ($this->livres->removeElement($livre) && $livre->getEtatsLivres() === $this) {
            $livre->setEtatsLivres(null);
        }

        return $this;
    }
}
