<?php

namespace App\Entity;

use App\Repository\CommentairesEmpruntsRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentairesEmpruntsRepository::class)]
class CommentairesEmprunts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $dateAjout = null;

    #[ORM\ManyToOne(inversedBy: 'commentairesEmprunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Emprunts $emprunts = null;

    #[ORM\ManyToOne(inversedBy: 'commentairesEmprunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateurs $utilisateurs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDateAjout(): ?DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(DateTimeInterface $dateAjout): static
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    public function getEmprunts(): ?Emprunts
    {
        return $this->emprunts;
    }

    public function setEmprunts(?Emprunts $emprunts): static
    {
        $this->emprunts = $emprunts;

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
}
