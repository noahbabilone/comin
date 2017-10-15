<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation As Gedmo;


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
     * @var string
     * @Gedmo\Slug(fields={"name"}, updatable=false)
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OpeningHours", mappedBy="restaurant")
     * @Assert\NotBlank()
     */
    private $openingHours;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="restaurants")
     */
    private $owner;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Offer", mappedBy="restaurant")
     * @Assert\NotBlank()
     */
    private $offers;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Menu", mappedBy="restaurant")
     * @Assert\NotBlank()
     */
    private $menus;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Card", mappedBy="restaurant")
     * @Assert\NotBlank()
     */
    private $cards;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Address", inversedBy="restaurants")
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Evaluation", mappedBy="restaurant")
     * @Assert\NotBlank()
     */
    private $evaluation;


    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column( type="datetime", nullable=true)
     */
    private $updated;

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
        $this->openingHours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->menus = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cards = new \Doctrine\Common\Collections\ArrayCollection();
        $this->evaluation = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Restaurant
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Restaurant
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Restaurant
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
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
     * Add openingHour
     *
     * @param \AppBundle\Entity\OpeningHours $openingHour
     *
     * @return Restaurant
     */
    public function addOpeningHour(\AppBundle\Entity\OpeningHours $openingHour)
    {
        $this->openingHours[] = $openingHour;

        return $this;
    }

    /**
     * Remove openingHour
     *
     * @param \AppBundle\Entity\OpeningHours $openingHour
     */
    public function removeOpeningHour(\AppBundle\Entity\OpeningHours $openingHour)
    {
        $this->openingHours->removeElement($openingHour);
    }

    /**
     * Get openingHours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOpeningHours()
    {
        return $this->openingHours;
    }

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\User $owner
     *
     * @return Restaurant
     */
    public function setOwner(\AppBundle\Entity\User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
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
        $this->offers[] = $offer;

        return $this;
    }

    /**
     * Remove offer
     *
     * @param \AppBundle\Entity\Offer $offer
     */
    public function removeOffer(\AppBundle\Entity\Offer $offer)
    {
        $this->offers->removeElement($offer);
    }

    /**
     * Get offers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffers()
    {
        return $this->offers;
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
        $this->menus[] = $menu;

        return $this;
    }

    /**
     * Remove menu
     *
     * @param \AppBundle\Entity\Menu $menu
     */
    public function removeMenu(\AppBundle\Entity\Menu $menu)
    {
        $this->menus->removeElement($menu);
    }

    /**
     * Get menus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenus()
    {
        return $this->menus;
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
        $this->cards[] = $card;

        return $this;
    }

    /**
     * Remove card
     *
     * @param \AppBundle\Entity\Card $card
     */
    public function removeCard(\AppBundle\Entity\Card $card)
    {
        $this->cards->removeElement($card);
    }

    /**
     * Get cards
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * Set address
     *
     * @param \AppBundle\Entity\Address $address
     *
     * @return Restaurant
     */
    public function setAddress(\AppBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \AppBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
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
}
