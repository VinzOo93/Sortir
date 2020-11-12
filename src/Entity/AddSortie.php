<?php


namespace App\Entity;



use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Component\Validator\Constraints\DateTime;

class AddSortie
{
    /**
     * @var string
     */
private $nom;
    /**
     * @var DateTime
     */
private $dateDebut;
    /**
     * @var DateTime
     */
private $dateLimInscr;
    /**
     * @var int
     */
private $placeMax;
    /**
     * @var int
     */
private $duree;
    /**
     * @var string
     */
private $infos;
    /**
     * @var Ville
     */
private $ville;
    /**
     * @var Lieu
     */
private $lieu;
    /**
     * @var float
     */
private $latitue;
    /**
     * @var float
     */
private $longitude;

    /**
     * AddSortie constructor.
     * @param Lieu|null $lieu
     * @param Ville|null $ville
     */
    public function __construct(?Lieu $lieu, ?Ville $ville)
    {
        $this->lieu = $lieu;
        $this->ville = $ville;

    }


    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     * @return AddSortie
     */
    public function setNom(?string $nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateDebut(): ?DateTime
    {
        return $this->dateDebut;
    }

    /**
     * @param DateTime|null $dateDebut
     * @return AddSortie
     */
    public function setDateDebut(?DateTime $dateDebut)
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateLimInscr(): ?DateTime
    {
        return $this->dateLimInscr;
    }

    /**
     * @param DateTime|null $dateLimInscr
     * @return AddSortie
     */
    public function setDateLimInscr(?DateTime $dateLimInscr)
    {
        $this->dateLimInscr = $dateLimInscr;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlaceMax(): ?int
    {
        return $this->placeMax;
    }

    /**
     * @param int|null $placeMax
     * @return AddSortie
     */
    public function setPlaceMax(?int $placeMax)
    {
        $this->placeMax = $placeMax;
        return $this;
    }

    /**
     * @return int
     */
    public function getDuree(): ?int
    {
        return $this->duree;
    }

    /**
     * @param int|null $duree
     * @return AddSortie
     */
    public function setDuree(?int $duree)
    {
        $this->duree = $duree;
        return $this;
    }

    /**
     * @return string
     */
    public function getInfos(): ?string
    {
        return $this->infos;
    }

    /**
     * @param string|null $infos
     * @return AddSortie
     */
    public function setInfos(?string $infos)
    {
        $this->infos = $infos;
        return $this;
    }

    /**
     * @return Ville|ArrayCollection|Collection
     */
    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    /**
     * @param Ville|null $ville
     * @return AddSortie
     */
    public function setVille(?Ville $ville): AddSortie
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return Lieu|ArrayCollection|Collection
     */
    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    /**
     * @param Lieu|null $lieu
     * @return AddSortie
     */
    public function setLieu(?Lieu $lieu): AddSortie
    {
        $this->lieu = $lieu;
        return $this;
    }



    /**
     * @return float
     */
    public function getLatitue():? float
    {
        return $this->latitue;
    }

    /**
     * @param float|null $latitue
     * @return AddSortie
     */
    public function setLatitue(?float $latitue)
    {
        $this->latitue = $latitue;
        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude():? float
    {
        return $this->longitude;
    }

    /**
     * @param float|null $longitude
     * @return AddSortie
     */
    public function setLongitude(?float $longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }


}