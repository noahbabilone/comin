<?php

namespace AppBundle\Entity;
use Gedmo\Mapping\Annotation As Gedmo;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MenuRepository")
 */
class Menu
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;
    
    /**
     * @var string
     * @Gedmo\Slug(fields={"name"}, updatable=false)
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;
    
      /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Restaurant", inversedBy="menus")
     */
    private $restaurant;
    
     /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="menus")
     */
    private $user;
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
     * Set name
     *
     * @param string $name
     *
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
}
