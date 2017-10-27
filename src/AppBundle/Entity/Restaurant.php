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
     * @var string
     *
     * @ORM\Column(name="rite", type="string", length=255, nullable=true)
     */
    private $rite;
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @var bool
     *
     * @ORM\Column(name="on_the_spot", type="boolean", nullable=true)
     */
    private $onTheSpot;

    /**
     * @var float
     *
     * @ORM\Column(name="on_the_spot_order_min", type="float", precision=10, scale=0, nullable=true)
     */
    private $onTheSpotOrderMin;

    /**
     * @var int
     *
     * @ORM\Column(name="on_the_spot_duration_min", type="integer", nullable=true)
     */
    private $onTheSpotDurationMin;

    /**
     * @var int
     *
     * @ORM\Column(name="on_the_spot_duration_max", type="integer", nullable=true)
     */
    private $onTheSpotDurationMax;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\City", mappedBy="restaurant")
     */
    private $communesDelivered;

    /**
     * @var int
     *
     * @ORM\Column(name="delivery_distance", type="integer", nullable=true)
     */
    private $deliveryDistance;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Delivery", mappedBy="restaurant")
     * @Assert\NotBlank()
     */
    private $deliveries;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OpeningHours", mappedBy="restaurant")
     * @Assert\NotBlank()
     */
    private $openingHours;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OpeningHours", mappedBy="restaurant")
     * @Assert\NotBlank()
     */
    private $exceptionalClosure;

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
    private $evaluations;

    /**
     * @var bool
     *
     * @ORM\Column(name="bank_card", type="boolean", nullable=true ,options={ "default":true })
     */
    private $bankCard;

    /**
     * @var bool
     *
     * @ORM\Column(name="paypal", type="boolean", nullable=true ,options={ "default":true })
     */
    private $paypal;

    /**
     * @var bool
     *
     * @ORM\Column(name="cash", type="boolean", nullable=true ,options={ "default":true })
     */
    private $cash;

    /**
     * @var bool
     *
     * @ORM\Column(name="ticket_restaurant", type="boolean", nullable=true ,options={ "default":false })
     */
    private $ticketRestaurant;

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
        $this->communesDelivered = new \Doctrine\Common\Collections\ArrayCollection();
        $this->deliveries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->openingHours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->exceptionalClosure = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->menus = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cards = new \Doctrine\Common\Collections\ArrayCollection();
        $this->evaluations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set phone
     *
     * @param string $phone
     *
     * @return Restaurant
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Restaurant
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
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
     * Set onTheSpotOrderMin
     *
     * @param float $onTheSpotOrderMin
     *
     * @return Restaurant
     */
    public function setOnTheSpotOrderMin($onTheSpotOrderMin)
    {
        $this->onTheSpotOrderMin = $onTheSpotOrderMin;

        return $this;
    }

    /**
     * Get onTheSpotOrderMin
     *
     * @return float
     */
    public function getOnTheSpotOrderMin()
    {
        return $this->onTheSpotOrderMin;
    }

    /**
     * Set onTheSpotDurationMin
     *
     * @param integer $onTheSpotDurationMin
     *
     * @return Restaurant
     */
    public function setOnTheSpotDurationMin($onTheSpotDurationMin)
    {
        $this->onTheSpotDurationMin = $onTheSpotDurationMin;

        return $this;
    }

    /**
     * Get onTheSpotDurationMin
     *
     * @return integer
     */
    public function getOnTheSpotDurationMin()
    {
        return $this->onTheSpotDurationMin;
    }

    /**
     * Set onTheSpotDurationMax
     *
     * @param integer $onTheSpotDurationMax
     *
     * @return Restaurant
     */
    public function setOnTheSpotDurationMax($onTheSpotDurationMax)
    {
        $this->onTheSpotDurationMax = $onTheSpotDurationMax;

        return $this;
    }

    /**
     * Get onTheSpotDurationMax
     *
     * @return integer
     */
    public function getOnTheSpotDurationMax()
    {
        return $this->onTheSpotDurationMax;
    }

    /**
     * Set deliveryDistance
     *
     * @param integer $deliveryDistance
     *
     * @return Restaurant
     */
    public function setDeliveryDistance($deliveryDistance)
    {
        $this->deliveryDistance = $deliveryDistance;

        return $this;
    }

    /**
     * Get deliveryDistance
     *
     * @return integer
     */
    public function getDeliveryDistance()
    {
        return $this->deliveryDistance;
    }

    /**
     * Set bankCard
     *
     * @param boolean $bankCard
     *
     * @return Restaurant
     */
    public function setBankCard($bankCard)
    {
        $this->bankCard = $bankCard;

        return $this;
    }

    /**
     * Get bankCard
     *
     * @return boolean
     */
    public function getBankCard()
    {
        return $this->bankCard;
    }

    /**
     * Set paypal
     *
     * @param boolean $paypal
     *
     * @return Restaurant
     */
    public function setPaypal($paypal)
    {
        $this->paypal = $paypal;

        return $this;
    }

    /**
     * Get paypal
     *
     * @return boolean
     */
    public function getPaypal()
    {
        return $this->paypal;
    }

    /**
     * Set cash
     *
     * @param boolean $cash
     *
     * @return Restaurant
     */
    public function setCash($cash)
    {
        $this->cash = $cash;

        return $this;
    }

    /**
     * Get cash
     *
     * @return boolean
     */
    public function getCash()
    {
        return $this->cash;
    }

    /**
     * Set ticketRestaurant
     *
     * @param boolean $ticketRestaurant
     *
     * @return Restaurant
     */
    public function setTicketRestaurant($ticketRestaurant)
    {
        $this->ticketRestaurant = $ticketRestaurant;

        return $this;
    }

    /**
     * Get ticketRestaurant
     *
     * @return boolean
     */
    public function getTicketRestaurant()
    {
        return $this->ticketRestaurant;
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
     * Add communesDelivered
     *
     * @param \AppBundle\Entity\City $communesDelivered
     *
     * @return Restaurant
     */
    public function addCommunesDelivered(\AppBundle\Entity\City $communesDelivered)
    {
        $this->communesDelivered[] = $communesDelivered;

        return $this;
    }

    /**
     * Remove communesDelivered
     *
     * @param \AppBundle\Entity\City $communesDelivered
     */
    public function removeCommunesDelivered(\AppBundle\Entity\City $communesDelivered)
    {
        $this->communesDelivered->removeElement($communesDelivered);
    }

    /**
     * Get communesDelivered
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommunesDelivered()
    {
        return $this->communesDelivered;
    }

    /**
     * Add delivery
     *
     * @param \AppBundle\Entity\Delivery $delivery
     *
     * @return Restaurant
     */
    public function addDelivery(\AppBundle\Entity\Delivery $delivery)
    {
        $this->deliveries[] = $delivery;

        return $this;
    }

    /**
     * Remove delivery
     *
     * @param \AppBundle\Entity\Delivery $delivery
     */
    public function removeDelivery(\AppBundle\Entity\Delivery $delivery)
    {
        $this->deliveries->removeElement($delivery);
    }

    /**
     * Get deliveries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeliveries()
    {
        return $this->deliveries;
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
     * Add exceptionalClosure
     *
     * @param \AppBundle\Entity\OpeningHours $exceptionalClosure
     *
     * @return Restaurant
     */
    public function addExceptionalClosure(\AppBundle\Entity\OpeningHours $exceptionalClosure)
    {
        $this->exceptionalClosure[] = $exceptionalClosure;

        return $this;
    }

    /**
     * Remove exceptionalClosure
     *
     * @param \AppBundle\Entity\OpeningHours $exceptionalClosure
     */
    public function removeExceptionalClosure(\AppBundle\Entity\OpeningHours $exceptionalClosure)
    {
        $this->exceptionalClosure->removeElement($exceptionalClosure);
    }

    /**
     * Get exceptionalClosure
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExceptionalClosure()
    {
        return $this->exceptionalClosure;
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
        $this->evaluations[] = $evaluation;

        return $this;
    }

    /**
     * Remove evaluation
     *
     * @param \AppBundle\Entity\Evaluation $evaluation
     */
    public function removeEvaluation(\AppBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations->removeElement($evaluation);
    }

    /**
     * Get evaluations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }
}
