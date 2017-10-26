<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation As Gedmo;

/**
 * Delivery
 *
 * @ORM\Table(name="delivery")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DeliveryRepository")
 */
class Delivery
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\City", mappedBy="restaurant")
     */
    private $city;

    /**
     * @var float
     *
     * @ORM\Column(name="delivery_price", type="float", precision=10, scale=0, nullable=true)
     */
    private $deliveryPrice;

    /**
     * @var bool
     *
     * @ORM\Column(name="take_away", type="boolean", nullable=true)
     */
    private $takeAway;

    /**
     * @var float
     *
     * @ORM\Column(name="take_away_order_min", type="float", precision=10, scale=0, nullable=true)
     */
    private $takeAwayOrderMin;

    /**
     * @var int
     *
     * @ORM\Column(name="take_away_duration_min", type="integer", nullable=true)
     */
    private $takeAwayDurationMin;

    /**
     * @var int
     *
     * @ORM\Column(name="take_away_duration_max", type="integer", nullable=true)
     */
    private $takeAwayDurationMax;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Restaurant", inversedBy="deliveries")
     */
    private $restaurant;

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
        $this->city = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set deliveryPrice
     *
     * @param float $deliveryPrice
     *
     * @return Delivery
     */
    public function setDeliveryPrice($deliveryPrice)
    {
        $this->deliveryPrice = $deliveryPrice;

        return $this;
    }

    /**
     * Get deliveryPrice
     *
     * @return float
     */
    public function getDeliveryPrice()
    {
        return $this->deliveryPrice;
    }

    /**
     * Set takeAway
     *
     * @param boolean $takeAway
     *
     * @return Delivery
     */
    public function setTakeAway($takeAway)
    {
        $this->takeAway = $takeAway;

        return $this;
    }

    /**
     * Get takeAway
     *
     * @return boolean
     */
    public function getTakeAway()
    {
        return $this->takeAway;
    }

    /**
     * Set takeAwayOrderMin
     *
     * @param float $takeAwayOrderMin
     *
     * @return Delivery
     */
    public function setTakeAwayOrderMin($takeAwayOrderMin)
    {
        $this->takeAwayOrderMin = $takeAwayOrderMin;

        return $this;
    }

    /**
     * Get takeAwayOrderMin
     *
     * @return float
     */
    public function getTakeAwayOrderMin()
    {
        return $this->takeAwayOrderMin;
    }

    /**
     * Set takeAwayDurationMin
     *
     * @param integer $takeAwayDurationMin
     *
     * @return Delivery
     */
    public function setTakeAwayDurationMin($takeAwayDurationMin)
    {
        $this->takeAwayDurationMin = $takeAwayDurationMin;

        return $this;
    }

    /**
     * Get takeAwayDurationMin
     *
     * @return integer
     */
    public function getTakeAwayDurationMin()
    {
        return $this->takeAwayDurationMin;
    }

    /**
     * Set takeAwayDurationMax
     *
     * @param integer $takeAwayDurationMax
     *
     * @return Delivery
     */
    public function setTakeAwayDurationMax($takeAwayDurationMax)
    {
        $this->takeAwayDurationMax = $takeAwayDurationMax;

        return $this;
    }

    /**
     * Get takeAwayDurationMax
     *
     * @return integer
     */
    public function getTakeAwayDurationMax()
    {
        return $this->takeAwayDurationMax;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Delivery
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
     * @return Delivery
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
     * @return Delivery
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
     * Add city
     *
     * @param \AppBundle\Entity\City $city
     *
     * @return Delivery
     */
    public function addCity(\AppBundle\Entity\City $city)
    {
        $this->city[] = $city;

        return $this;
    }

    /**
     * Remove city
     *
     * @param \AppBundle\Entity\City $city
     */
    public function removeCity(\AppBundle\Entity\City $city)
    {
        $this->city->removeElement($city);
    }

    /**
     * Get city
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set restaurant
     *
     * @param \AppBundle\Entity\Restaurant $restaurant
     *
     * @return Delivery
     */
    public function setRestaurant(\AppBundle\Entity\Restaurant $restaurant = null)
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get restaurant
     *
     * @return \AppBundle\Entity\Restaurant
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }
}
