<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Mapping\Annotation As Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    const ROLE_USER = 'ROLE_USER';
    const ROLE_CUSTOMER = 'ROLE_CUSTOMER';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255, nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    protected $phone;
    /**
     * @var string
     *
     * @ORM\Column(name="home_phone", type="string", length=255, nullable=true)
     */
    protected $homePhone;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $creator;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Restaurant", mappedBy="user")
     */
    private $restaurants;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Evaluation", mappedBy="user")
     * @Assert\NotBlank()
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Address", mappedBy="user")
     * @Assert\NotBlank()
     */
    private $addresses;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Card", inversedBy="user")
     */
    private $cards; 
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Offer", inversedBy="user")
     */
    private $offers;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Menu", inversedBy="user")
     */
    private $menus;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="user")
     */
    private $products;


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


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    


    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
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
     * Set homePhone
     *
     * @param string $homePhone
     *
     * @return User
     */
    public function setHomePhone($homePhone)
    {
        $this->homePhone = $homePhone;

        return $this;
    }

    /**
     * Get homePhone
     *
     * @return string
     */
    public function getHomePhone()
    {
        return $this->homePhone;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return User
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
     * @return User
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
     * Set creator
     *
     * @param \AppBundle\Entity\User $creator
     *
     * @return User
     */
    public function setCreator(\AppBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Add restaurant
     *
     * @param \AppBundle\Entity\Restaurant $restaurant
     *
     * @return User
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

    /**
     * Add note
     *
     * @param \AppBundle\Entity\Evaluation $note
     *
     * @return User
     */
    public function addNote(\AppBundle\Entity\Evaluation $note)
    {
        $this->notes[] = $note;

        return $this;
    }

    /**
     * Remove note
     *
     * @param \AppBundle\Entity\Evaluation $note
     */
    public function removeNote(\AppBundle\Entity\Evaluation $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Add address
     *
     * @param \AppBundle\Entity\Address $address
     *
     * @return User
     */
    public function addAddress(\AppBundle\Entity\Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \AppBundle\Entity\Address $address
     */
    public function removeAddress(\AppBundle\Entity\Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Set cards
     *
     * @param \AppBundle\Entity\Card $cards
     *
     * @return User
     */
    public function setCards(\AppBundle\Entity\Card $cards = null)
    {
        $this->cards = $cards;

        return $this;
    }

    /**
     * Get cards
     *
     * @return \AppBundle\Entity\Card
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * Set offers
     *
     * @param \AppBundle\Entity\Offer $offers
     *
     * @return User
     */
    public function setOffers(\AppBundle\Entity\Offer $offers = null)
    {
        $this->offers = $offers;

        return $this;
    }

    /**
     * Get offers
     *
     * @return \AppBundle\Entity\Offer
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * Set menus
     *
     * @param \AppBundle\Entity\Menu $menus
     *
     * @return User
     */
    public function setMenus(\AppBundle\Entity\Menu $menus = null)
    {
        $this->menus = $menus;

        return $this;
    }

    /**
     * Get menus
     *
     * @return \AppBundle\Entity\Menu
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * Set products
     *
     * @param \AppBundle\Entity\Product $products
     *
     * @return User
     */
    public function setProducts(\AppBundle\Entity\Product $products = null)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * Get products
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProducts()
    {
        return $this->products;
    }
}
