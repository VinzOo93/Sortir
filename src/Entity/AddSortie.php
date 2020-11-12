<?php


namespace App\Entity;



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
     * @var string
     */
private $ville;
    /**
     * @var string
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
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return AddSortie
     */
    public function setNom(string $nom): AddSortie
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateDebut(): DateTime
    {
        return $this->dateDebut;
    }

    /**
     * @param DateTime $dateDebut
     * @return AddSortie
     */
    public function setDateDebut(DateTime $dateDebut): AddSortie
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateLimInscr(): DateTime
    {
        return $this->dateLimInscr;
    }

    /**
     * @param DateTime $dateLimInscr
     * @return AddSortie
     */
    public function setDateLimInscr(DateTime $dateLimInscr): AddSortie
    {
        $this->dateLimInscr = $dateLimInscr;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlaceMax(): int
    {
        return $this->placeMax;
    }

    /**
     * @param int $placeMax
     * @return AddSortie
     */
    public function setPlaceMax(int $placeMax): AddSortie
    {
        $this->placeMax = $placeMax;
        return $this;
    }

    /**
     * @return int
     */
    public function getDuree(): int
    {
        return $this->duree;
    }

    /**
     * @param int $duree
     * @return AddSortie
     */
    public function setDuree(int $duree): AddSortie
    {
        $this->duree = $duree;
        return $this;
    }

    /**
     * @return string
     */
    public function getInfos(): string
    {
        return $this->infos;
    }

    /**
     * @param string $infos
     * @return AddSortie
     */
    public function setInfos(string $infos): AddSortie
    {
        $this->infos = $infos;
        return $this;
    }

    /**
     * @return string
     */
    public function getVille(): string
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     * @return AddSortie
     */
    public function setVille(string $ville): AddSortie
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return string
     */
    public function getLieu(): string
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     * @return AddSortie
     */
    public function setLieu(string $lieu): AddSortie
    {
        $this->lieu = $lieu;
        return $this;
    }

    /**
     * @return float
     */
    public function getLatitue(): float
    {
        return $this->latitue;
    }

    /**
     * @param float $latitue
     * @return AddSortie
     */
    public function setLatitue(float $latitue): AddSortie
    {
        $this->latitue = $latitue;
        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     * @return AddSortie
     */
    public function setLongitude(float $longitude): AddSortie
    {
        $this->longitude = $longitude;
        return $this;
    }


}