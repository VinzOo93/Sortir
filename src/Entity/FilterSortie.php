<?php


namespace App\Entity;


use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Collection;


class FilterSortie
{
    /**
     * @var Campus
     */
    private $campus;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var DateTime
     *
     */
    private $dateMax;

    /**
     * @var DateTime
     */
    private $dateMin;

    /**
     * @var bool
     */
    private $organisateur = true;

    /**
     * @var bool
     */
    private $inscrit = true;

    /**
     * @var bool
     */
    private $noInscrit = true;

    /**
     * @var bool
     */
    private $past = false;

    /**
     * FilterSortie constructor.
     * @param Campus $campus
     */
    public function __construct(Campus $campus)
    {
       $this->campus = $campus;
    }


    /**
     * @return Campus|ArrayCollection|Collection
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param Campus|null $campus
     * @return FilterSortie
     */
    public function setCampus(?Campus $campus): FilterSortie
    {
        $this->campus = $campus;
        return $this;
    }

    /**
     * @return string
     */
    public function getName():? string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return FilterSortie
     */
    public function setName(?string $name): FilterSortie
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateMax() :?DateTime
    {
        return $this->dateMax;
    }

    /**
     * @param DateTime|null $dateMax
     * @return FilterSortie
     */
    public function setDateMax(?DateTime $dateMax)
    {
        $this->dateMax = $dateMax;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateMin():?DateTime
    {
        return $this->dateMin;
    }

    /**
     * @param DateTime|null $dateMin
     * @return FilterSortie
     */
    public function setDateMin(?DateTime $dateMin)
    {
        $this->dateMin = $dateMin;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOrganisateur(): bool
    {
        return $this->organisateur;
    }

    /**
     * @param bool $organisateur
     * @return FilterSortie
     */
    public function setOrganisateur(bool $organisateur): FilterSortie
    {
        $this->organisateur = $organisateur;
        return $this;
    }

    /**
     * @return bool
     */
    public function isInscrit(): bool
    {
        return $this->inscrit;
    }

    /**
     * @param bool $inscrit
     * @return FilterSortie
     */
    public function setInscrit(bool $inscrit): FilterSortie
    {
        $this->inscrit = $inscrit;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNoInscrit(): bool
    {
        return $this->noInscrit;
    }

    /**
     * @param bool $noInscrit
     * @return FilterSortie
     */
    public function setNoInscrit(bool $noInscrit): FilterSortie
    {
        $this->noInscrit = $noInscrit;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPast(): bool
    {
        return $this->past;
    }

    /**
     * @param bool $past
     * @return FilterSortie
     */
    public function setPast(bool $past): FilterSortie
    {
        $this->past = $past;
        return $this;
    }




}