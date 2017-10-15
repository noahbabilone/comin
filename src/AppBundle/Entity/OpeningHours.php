<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation As Gedmo;

/**
 * OpeningHours
 *
 * @ORM\Table(name="opening_hours")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OpeningHoursRepository")
 */
class OpeningHours
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
     * @var int
     *
     * @ORM\Column(name="day", type="integer", nullable=true)
     */
    private $day;

    /**
     * @var int
     *
     * @ORM\Column(name="morningStartTime", type="integer", nullable=true)
     */
    private $morningStartTime;

    /**
     * @var int
     *
     * @ORM\Column(name="morningEndTime", type="integer", nullable=true)
     */
    private $morningEndTime;

    /**
     * @var int
     *
     * @ORM\Column(name="eveningStartTime", type="integer", nullable=true)
     */
    private $eveningStartTime;

    /**
     * @var int
     *
     * @ORM\Column(name="eveningEndTime", type="integer", nullable=true)
     */
    private $eveningEndTime;

    /**
     * @var bool
     *
     * @ORM\Column(name="open", type="boolean", options={ "default":true })
     */
    private $open;

    /**
     * @var int
     *
     * @ORM\Column(name="noOpeningStartTime", type="integer", nullable=true)
     */
    private $noOpeningStartTime;

    /**
     * @var int
     *
     * @ORM\Column(name="noOpeningEndTime", type="integer", nullable=true)
     */
    private $noOpeningEndTime;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Restaurant", inversedBy="openingHours")
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set day
     *
     * @param integer $day
     *
     * @return OpeningHours
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set morningStartTime
     *
     * @param integer $morningStartTime
     *
     * @return OpeningHours
     */
    public function setMorningStartTime($morningStartTime)
    {
        $this->morningStartTime = $morningStartTime;

        return $this;
    }

    /**
     * Get morningStartTime
     *
     * @return integer
     */
    public function getMorningStartTime()
    {
        return $this->morningStartTime;
    }

    /**
     * Set morningEndTime
     *
     * @param integer $morningEndTime
     *
     * @return OpeningHours
     */
    public function setMorningEndTime($morningEndTime)
    {
        $this->morningEndTime = $morningEndTime;

        return $this;
    }

    /**
     * Get morningEndTime
     *
     * @return integer
     */
    public function getMorningEndTime()
    {
        return $this->morningEndTime;
    }

    /**
     * Set eveningStartTime
     *
     * @param integer $eveningStartTime
     *
     * @return OpeningHours
     */
    public function setEveningStartTime($eveningStartTime)
    {
        $this->eveningStartTime = $eveningStartTime;

        return $this;
    }

    /**
     * Get eveningStartTime
     *
     * @return integer
     */
    public function getEveningStartTime()
    {
        return $this->eveningStartTime;
    }

    /**
     * Set eveningEndTime
     *
     * @param integer $eveningEndTime
     *
     * @return OpeningHours
     */
    public function setEveningEndTime($eveningEndTime)
    {
        $this->eveningEndTime = $eveningEndTime;

        return $this;
    }

    /**
     * Get eveningEndTime
     *
     * @return integer
     */
    public function getEveningEndTime()
    {
        return $this->eveningEndTime;
    }

    /**
     * Set open
     *
     * @param boolean $open
     *
     * @return OpeningHours
     */
    public function setOpen($open)
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Get open
     *
     * @return boolean
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Set noOpeningStartTime
     *
     * @param integer $noOpeningStartTime
     *
     * @return OpeningHours
     */
    public function setNoOpeningStartTime($noOpeningStartTime)
    {
        $this->noOpeningStartTime = $noOpeningStartTime;

        return $this;
    }

    /**
     * Get noOpeningStartTime
     *
     * @return integer
     */
    public function getNoOpeningStartTime()
    {
        return $this->noOpeningStartTime;
    }

    /**
     * Set noOpeningEndTime
     *
     * @param integer $noOpeningEndTime
     *
     * @return OpeningHours
     */
    public function setNoOpeningEndTime($noOpeningEndTime)
    {
        $this->noOpeningEndTime = $noOpeningEndTime;

        return $this;
    }

    /**
     * Get noOpeningEndTime
     *
     * @return integer
     */
    public function getNoOpeningEndTime()
    {
        return $this->noOpeningEndTime;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return OpeningHours
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
     * @return OpeningHours
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
     * @return OpeningHours
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
     * @return OpeningHours
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
