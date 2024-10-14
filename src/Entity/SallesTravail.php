<?php

namespace App\Entity;

use App\Repository\SallesTravailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SallesTravailRepository::class)]
#[Vich\Uploadable]
class SallesTravail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'salles_images', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $capacite = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $disponibilite = null;

    #[ORM\ManyToMany(targetEntity: Equipements::class, mappedBy: 'SallesTravail')]
    private Collection $equipements;

    #[ORM\OneToMany(targetEntity: Reservations::class, mappedBy: 'sallesTravail')]
    private Collection $reservations;

    #[ORM\Column]
    private ?bool $wifi = null;

    #[ORM\Column]
    private ?bool $projecteur = null;

    #[ORM\Column]
    private ?bool $tableau = null;

    #[ORM\Column]
    private ?bool $priseElectrique = null;

    #[ORM\Column]
    private ?bool $television = null;

    #[ORM\Column]
    private ?bool $climatisation = null;



    public function __construct()
    {
        $this->equipements = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }




    /**
     * * @Vich\UploadableField(mapping: 'salles_images', fileNameProperty: 'imageName', size: 'imageSize')
     * @Assert\File(
     *     maxSize="20M", // Définissez la taille maximale autorisée pour le fichier
     *     mimeTypes={"image/jpeg", "image/png", "image/gif"} // Types MIME autorisés
     * )
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
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

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function isDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getWifi(): ?bool
    {
        return $this->wifi;
    }

    public function setWifi(bool $wifi): static
    {
        $this->wifi = $wifi;

        return $this;
    }

    public function getProjecteur(): ?bool
    {
        return $this->projecteur;
    }

    public function setProjecteur(bool $projecteur): static
    {
        $this->projecteur = $projecteur;

        return $this;
    }

    public function getTableau(): ?bool
    {
        return $this->tableau;
    }

    public function setTableau(bool $tableau): static
    {
        $this->tableau = $tableau;

        return $this;
    }

    public function getPriseElectrique(): ?bool
    {
        return $this->priseElectrique;
    }

    public function setPriseElectrique(bool $priseElectrique): static
    {
        $this->priseElectrique = $priseElectrique;

        return $this;
    }

    public function getTelevision(): ?bool
    {
        return $this->television;
    }

    public function setTelevision(bool $television): static
    {
        $this->television = $television;

        return $this;
    }

    public function getClimatisation(): ?bool
    {
        return $this->climatisation;
    }

    public function setClimatisation(bool $climatisation): static
    {
        $this->climatisation = $climatisation;

        return $this;
    }

    /**
     * @return Collection<int, Equipements>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipements $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->addSallesTravail($this);
        }

        return $this;
    }

    public function removeEquipement(Equipements $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            $equipement->removeSallesTravail($this);
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
            $reservation->setSallesTravail($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getSallesTravail() === $this) {
                $reservation->setSallesTravail(null);
            }
        }

        return $this;
    }
}
