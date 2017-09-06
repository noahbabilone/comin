<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Restaurant
 *
 * @ORM\Table(name="restaurant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RestaurantRepository")
 */
class Restaurant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Evaluation")
     * @Assert\NotBlank()
     */
    private $evaluation;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Offer")
     * @Assert\NotBlank()
     */
    private $offer;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Menu")
     * @Assert\NotBlank()
     */
    private $menu;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Card")
     * @Assert\NotBlank()
     */
    private $card;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="speciality", type="string", length=255, nullable=true)
     */
    private $speciality;

    /**
     * @var bool
     *
     * @ORM\Column(name="onTheSpot", type="boolean", nullable=true)
     */
    private $onTheSpot;

    /**
     * @var string
     *
     * @ORM\Column(name="rite", type="string", length=255, nullable=true)
     */
    private $rite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="OpeningHours", type="datetime")
     */
    private $openingHours;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var bool
     *
     * @ORM\Column(name="visible", type="boolean", nullable=true ,options={ "default":true })
     */
    private $visible;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evaluation = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offer = new \Doctrine\Common\Collections\ArrayCollection();
        $this->menu = new \Doctrine\Common\Collections\ArrayCollection();
        $this->card = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Restaurant
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Restaurant
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set speciality
     *
     * @param string $speciality
     *
     * @return Restaurant
     */
    public function setSpeciality($speciality)
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * Get speciality
     *
     * @return string
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * Set onTheSpot
     *
     * @param boolean $onTheSpot
     *
     * @return Restaurant
     */
    public function setOnTheSpot($onTheSpot)
    {
        $this->onTheSpot = $onTheSpot;

        return $this;
    }

    /**
     * Get onTheSpot
     *
     * @return boolean
     */
    public function getOnTheSpot()
    {
        return $this->onTheSpot;
    }

    /**
     * Set rite
     *
     * @param string $rite
     *
     * @return Restaurant
     */
    public function setRite($rite)
    {
        $this->rite = $rite;

        return $this;
    }

    /**
     * Get rite
     *
     * @return string
     */
    public function getRite()
    {
        return $this->rite;
    }

    /**
     * Set openingHours
     *
     * @param \DateTime $openingHours
     *
     * @return Restaurant
     */
    public function setOpeningHours($openingHours)
    {
        $this->openingHours = $openingHours;

        return $this;
    }

    /**
     * Get openingHours
     *
     * @return \DateTime
     */
    public function getOpeningHours()
    {
        return $this->openingHours;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Restaurant
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return Restaurant
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Add evaluation
     *
     * @param \AppBundle\Entity\Evaluation $evaluation
     *
     * @return Restaurant
     */
    public function addEvaluation(\AppBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluation[] = $evaluation;

        return $this;
    }

    /**
     * Remove evaluation
     *
     * @param \AppBundle\Entity\Evaluation $evaluation
     */
    public function removeEvaluation(\AppBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluation->removeElement($evaluation);
    }

    /**
     * Get evaluation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * Add offer
     *
     * @param \AppBundle\Entity\Offer $offer
     *
     * @return Restaurant
     */
    public function addOffer(\AppBundle\Entity\Offer $offer)
    {
        $this->offer[] = $offer;

        return $this;
    }

    /**
     * Remove offer
     *
     * @param \AppBundle\Entity\Offer $offer
     */
    public function removeOffer(\AppBundle\Entity\Offer $offer)
    {
        $this->offer->removeElement($offer);
    }

    /**
     * Get offer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * Add menu
     *
     * @param \AppBundle\Entity\Menu $menu
     *
     * @return Restaurant
     */
    public function addMenu(\AppBundle\Entity\Menu $menu)
    {
        $this->menu[] = $menu;

        return $this;
    }

    /**
     * Remove menu
     *
     * @param \AppBundle\Entity\Menu $menu
     */
    public function removeMenu(\AppBundle\Entity\Menu $menu)
    {
        $this->menu->removeElement($menu);
    }

    /**
     * Get menu
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Add card
     *
     * @param \AppBundle\Entity\Card $card
     *
     * @return Restaurant
     */
    public function addCard(\AppBundle\Entity\Card $card)
    {
        $this->card[] = $card;

        return $this;
    }

    /**
     * Remove card
     *
     * @param \AppBundle\Entity\Card $card
     */
    public function removeCard(\AppBundle\Entity\Card $card)
    {
        $this->card->removeElement($card);
    }

    /**
     * Get card
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCard()
    {
        return $this->card;
    }
}
