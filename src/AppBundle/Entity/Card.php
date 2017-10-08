<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation As Gedmo;


/**
 * Card
 *
 * @ORM\Table(name="card")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CardRepository")
 */
class Card
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Restaurant", inversedBy="cards")
     */
    private $restaurant;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="cards")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Category")
     */
    private $category;

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
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Card
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
     * @return Card
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
     * @return Card
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
     * @return Card
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
     * @return Card
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
     * @return Card
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

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Card
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
     * Add category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Card
     */
    public function addCategory(\AppBundle\Entity\Category $category)
    {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Category $category
     */
    public function removeCategory(\AppBundle\Entity\Category $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategory()
    {
        return $this->category;
    }
}
