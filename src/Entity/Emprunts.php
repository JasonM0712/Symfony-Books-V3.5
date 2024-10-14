<?php

namespace App\Entity;

use App\Repository\EmpruntsRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpruntsRepository::class)]
class Emprunts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $dateDemande = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $dateRestitutionPrevisionnelle = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $dateRestitutionEffective = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $restitue = true;

    #[ORM\Column]
    private ?bool $extensionEmprunt = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateurs $utilisateurs = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Livres $livres = null;

    #[ORM\OneToMany(targetEntity: CommentairesEmprunts::class, mappedBy: 'emprunts', orphanRemoval: true)]
    private Collection $commentairesEmprunts;

    public function __construct()
    {
        $this->commentairesEmprunts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDemande(): ?DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(DateTimeInterface $dateDemande): static
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getDateRestitutionPrevisionnelle(): ?DateTimeInterface
    {
        return $this->dateRestitutionPrevisionnelle;
    }

    public function setDateRestitutionPrevisionnelle(DateTimeInterface $dateRestitutionPrevisionnelle): static
    {
        $this->dateRestitutionPrevisionnelle = $dateRestitutionPrevisionnelle;

        return $this;
    }

    public function getDateRestitutionEffective(): ?DateTimeInterface
    {
        return $this->dateRestitutionEffective;
    }

    public function setDateRestitutionEffective(?DateTimeInterface $dateRestitutionEffective): static
    {
        $this->dateRestitutionEffective = $dateRestitutionEffective;

        return $this;
    }

    public function isExtensionEmprunt(): ?bool
    {
        return $this->extensionEmprunt;
    }

    public function setExtensionEmprunt(bool $extensionEmprunt): static
    {
        $this->extensionEmprunt = $extensionEmprunt;

        return $this;
    }

    public function getUtilisateurs(): ?Utilisateurs
    {
        return $this->utilisateurs;
    }

    public function setUtilisateurs(?Utilisateurs $utilisateurs): static
    {
        $this->utilisateurs = $utilisateurs;

        return $this;
    }

    public function getLivres(): ?Livres
    {
        return $this->livres;
    }

    public function setLivres(?Livres $livres): static
    {
        $this->livres = $livres;

        return $this;
    }

    /**
     * @return Collection<int, CommentairesEmprunts>
     */
    public function getCommentairesEmprunts(): Collection
    {
        return $this->commentairesEmprunts;
    }

    public function addCommentairesEmprunt(CommentairesEmprunts $commentairesEmprunt): static
    {
        if (!$this->commentairesEmprunts->contains($commentairesEmprunt)) {
            $this->commentairesEmprunts->add($commentairesEmprunt);
            $commentairesEmprunt->setEmprunts($this);
        }

        return $this;
    }

    public function removeCommentairesEmprunt(CommentairesEmprunts $commentairesEmprunt): static
    {
        // set the owning side to null (unless already changed)
        if ($this->commentairesEmprunts->removeElement($commentairesEmprunt) && $commentairesEmprunt->getEmprunts() === $this) {
            $commentairesEmprunt->setEmprunts(null);
        }

        return $this;
    }

    public function getRestitue(): bool
    {
        return $this->restitue;
    }

    public function setRestitue(bool $restitue): self
    {
        $this->restitue = $restitue;
        return $this;
    }
}
