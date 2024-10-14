<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateursRepository::class)]
class Utilisateurs implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var ?string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 50)]
    private ?string $codePostal = null;

    #[ORM\Column(length: 100)]
    private ?string $ville = null;

    #[ORM\Column(type: 'bigint')]
    private ?int $numeroTelephone = null;

    #[ORM\Column]
    private ?bool $langueDuSiteFr = null;

    #[ORM\OneToMany(targetEntity: Abonnement::class, mappedBy: 'utilisateur')]
    private Collection $abonnements;

    #[ORM\OneToMany(targetEntity: Reservations::class, mappedBy: 'utilisateurs')]
    private Collection $reservations;

    #[ORM\OneToMany(targetEntity: Commentaires::class, mappedBy: 'utilisateurs', orphanRemoval: true)]
    private Collection $commentaires;

    #[ORM\OneToMany(targetEntity: Notes::class, mappedBy: 'utilisateurs', orphanRemoval: true)]
    private Collection $notes;

    #[ORM\OneToMany(targetEntity: Emprunts::class, mappedBy: 'utilisateurs')]
    private Collection $emprunts;

    #[ORM\OneToMany(targetEntity: CommentairesEmprunts::class, mappedBy: 'utilisateurs', orphanRemoval: true)]
    private Collection $commentairesEmprunts;

    public function __construct()
    {
        $this->abonnements = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->emprunts = new ArrayCollection();
        $this->commentairesEmprunts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getDateNaissance(): ?DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNumeroTelephone(): ?int
    {
        return $this->numeroTelephone;
    }

    public function setNumeroTelephone(int $numeroTelephone): static
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    public function isLangueDuSiteFr(): ?bool
    {
        return $this->langueDuSiteFr;
    }

    public function setLangueDuSiteFr(bool $langueDuSiteFr): static
    {
        $this->langueDuSiteFr = $langueDuSiteFr;

        return $this;
    }

    /**
     * @return Collection<int, Abonnement>
     */
    public function getAbonnements(): Collection
    {
        return $this->abonnements;
    }

    public function addAbonnement(Abonnement $abonnement): static
    {
        if (!$this->abonnements->contains($abonnement)) {
            $this->abonnements->add($abonnement);
            $abonnement->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAbonnement(Abonnement $abonnement): static
    {
        // set the owning side to null (unless already changed)
        if ($this->abonnements->removeElement($abonnement) && $abonnement->getUtilisateur() === $this) {
            $abonnement->setUtilisateur(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservations>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservations $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setUtilisateurs($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): static
    {
        // set the owning side to null (unless already changed)
        if ($this->reservations->removeElement($reservation) && $reservation->getUtilisateurs() === $this) {
            $reservation->setUtilisateurs(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaires>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setUtilisateurs($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): static
    {
        // set the owning side to null (unless already changed)
        if ($this->commentaires->removeElement($commentaire) && $commentaire->getUtilisateurs() === $this) {
            $commentaire->setUtilisateurs(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Notes>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Notes $note): static
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setUtilisateurs($this);
        }

        return $this;
    }

    public function removeNote(Notes $note): static
    {
        // set the owning side to null (unless already changed)
        if ($this->notes->removeElement($note) && $note->getUtilisateurs() === $this) {
            $note->setUtilisateurs(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Emprunts>
     */
    public function getEmprunts(): Collection
    {
        return $this->emprunts;
    }

    public function addEmprunt(Emprunts $emprunt): static
    {
        if (!$this->emprunts->contains($emprunt)) {
            $this->emprunts->add($emprunt);
            $emprunt->setUtilisateurs($this);
        }

        return $this;
    }

    public function removeEmprunt(Emprunts $emprunt): static
    {
        // set the owning side to null (unless already changed)
        if ($this->emprunts->removeElement($emprunt) && $emprunt->getUtilisateurs() === $this) {
            $emprunt->setUtilisateurs(null);
        }

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
            $commentairesEmprunt->setUtilisateurs($this);
        }

        return $this;
    }

    public function removeCommentairesEmprunt(CommentairesEmprunts $commentairesEmprunt): static
    {
        // set the owning side to null (unless already changed)
        if ($this->commentairesEmprunts->removeElement($commentairesEmprunt) && $commentairesEmprunt->getUtilisateurs() === $this) {
            $commentairesEmprunt->setUtilisateurs(null);
        }

        return $this;
    }
}
