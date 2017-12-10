<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation As Gedmo;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 */
class Address
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
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=true)
     */
    private $content;

    /**
     * @var string
     * @Gedmo\Slug(fields={"street","id"}, updatable=false)
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\City")
     * @Assert\NotBlank()
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="addresses")
     * @Assert\NotBlank()
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Restaurant", mappedBy="address")
     * @Assert\NotBlank()
     */
    private $restaurants;

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
     * Constructor
     */
    public function __construct()
    {
        $this->restaurants = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set street
     *
     * @param string $street
     *
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Address
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Address
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Address
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
     * @return Address
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
     * @return Address
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
     * Set city
     *
     * @param \AppBundle\Entity\City $city
     *
     * @return Address
     */
    public function setCity(\AppBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \AppBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Address
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add restaurant
     *
     * @param \AppBundle\Entity\Restaurant $restaurant
     *
     * @return Address
     */
    public function addRestaurant(\AppBundle\Entity\Restaurant $restaurant)
    {
        $this->restaurants[] = $restaurant;

        return $this;
    }

    /**
     * Remove restaurant
     *
     * @param \AppBundle\Entity\Restaurant $restaurant
     */
    public function removeRestaurant(\AppBundle\Entity\Restaurant $restaurant)
    {
        $this->restaurants->removeElement($restaurant);
    }

    /**
     * Get restaurants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRestaurants()
    {
        return $this->restaurants;
    }
}
