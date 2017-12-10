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
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=true)
     */
    private $price;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var float
     *
     * @ORM\Column(name="noon_order_min", type="float", precision=10, scale=0, nullable=true)
     */
    private $noonOrderMin;  
    /**
     * @var float
     *
     * @ORM\Column(name="night_order_min", type="float", precision=10, scale=0, nullable=true)
     */
    private $nightOrderMin;
    /**
     * @var float
     *
     * @ORM\Column(name="order_min", type="float", precision=10, scale=0, nullable=true)
     */
    private $orderMin;

    /**
     * @var int
     *
     * @ORM\Column(name="duration_min", type="integer", nullable=true)
     */
    private $durationMin;

    /**
     * @var int
     *
     * @ORM\Column(name="duration_max", type="integer", nullable=true)
     */
    private $durationMax;

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
     * @ORM\Column(name="visible", type="boolean",options={ "default":true })
     */

    private $visible;



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
     * Set city
     *
     * @param string $city
     *
     * @return Delivery
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Delivery
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Delivery
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set noonOrderMin
     *
     * @param float $noonOrderMin
     *
     * @return Delivery
     */
    public function setNoonOrderMin($noonOrderMin)
    {
        $this->noonOrderMin = $noonOrderMin;

        return $this;
    }

    /**
     * Get noonOrderMin
     *
     * @return float
     */
    public function getNoonOrderMin()
    {
        return $this->noonOrderMin;
    }

    /**
     * Set nightOrderMin
     *
     * @param float $nightOrderMin
     *
     * @return Delivery
     */
    public function setNightOrderMin($nightOrderMin)
    {
        $this->nightOrderMin = $nightOrderMin;

        return $this;
    }

    /**
     * Get nightOrderMin
     *
     * @return float
     */
    public function getNightOrderMin()
    {
        return $this->nightOrderMin;
    }

    /**
     * Set orderMin
     *
     * @param float $orderMin
     *
     * @return Delivery
     */
    public function setOrderMin($orderMin)
    {
        $this->orderMin = $orderMin;

        return $this;
    }

    /**
     * Get orderMin
     *
     * @return float
     */
    public function getOrderMin()
    {
        return $this->orderMin;
    }

    /**
     * Set durationMin
     *
     * @param integer $durationMin
     *
     * @return Delivery
     */
    public function setDurationMin($durationMin)
    {
        $this->durationMin = $durationMin;

        return $this;
    }

    /**
     * Get durationMin
     *
     * @return integer
     */
    public function getDurationMin()
    {
        return $this->durationMin;
    }

    /**
     * Set durationMax
     *
     * @param integer $durationMax
     *
     * @return Delivery
     */
    public function setDurationMax($durationMax)
    {
        $this->durationMax = $durationMax;

        return $this;
    }

    /**
     * Get durationMax
     *
     * @return integer
     */
    public function getDurationMax()
    {
        return $this->durationMax;
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
