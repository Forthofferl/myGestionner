<?php

namespace FLOT\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
#use ForthoCorp\MainBundle\Entity\Address;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="FLOT\UserBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $lastname;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $birthdate;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $country;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $job;

    /**
     * @ORM\Column(name="api_key", type="string", length=100, nullable=true)
     */
    protected $apiKey;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $company;

    /**
     * @ORM\Column(name="marital_status", type="string", length=30, nullable=true)
     */
    protected $maritalStatus;

    /**
     * @ORM\Column(name="civility", type="string", length=30, nullable=true)
     */
    protected $civility;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $mobile;

    /**
     * @ORM\OneToOne(targetEntity="FLOT\MainBundle\Entity\Address", orphanRemoval=true, cascade={"remove"})
     * @ORM\JoinColumn(name="address_id", onDelete="CASCADE")
     */
    protected $address;

    /**
     * @ORM\OneToOne(targetEntity="FLOT\MainBundle\Entity\Address", orphanRemoval=true, cascade={"remove"})
     * @ORM\JoinColumn(name="address2_id", onDelete="CASCADE")
     */
    protected $address2;

    /**
     * @ORM\OneToOne(targetEntity="FLOT\MainBundle\Entity\Image")
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id", nullable=true)
     */
    protected $avatar;

    /**
     * @ORM\Column(name="template", type="string", length=30, nullable=true)
     */
    protected $template;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(name="deleted_by", referencedColumnName="id")
     */
    protected $deletedBy;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->createdAt = new \DateTime('now');
        $this->nbCourses = 0;
        $this->verified = false;
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

//    /**
//     * Set address
//     *
//     * @param Address $address
//     * @return User
//     */
//    public function setAddress(Address $address = null)
//    {
//        $this->address = $address;
//
//        return $this;
//    }
//
//    /**
//     * Get address
//     *
//     * @return Address
//     */
//    public function getAddress()
//    {
//        return $this->address;
//    }
//
//    /**
//     * Set address2
//     *
//     * @param Address $address
//     * @return User
//     */
//    public function setAddress2(Address $address = null)
//    {
//        $this->address2 = $address;
//
//        return $this;
//    }
//
//    /**
//     * Get address2
//     *
//     * @return Address
//     */
//    public function getAddress2()
//    {
//        return $this->address2;
//    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }
    
    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }


    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }


    /**
     * Set country
     *
     * @param string $country
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }


    /**
     * Set job
     *
     * @param string $job
     * @return User
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set apiKey
     *
     * @param string $apiKey
     * @return User
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }


    /**
     * Set template
     *
     * @param string $template
     * @return User
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }


    /**
     * Set company
     *
     * @param string $company
     * @return User
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }


    /**
     * Set maritalStatus
     *
     * @param string $maritalStatus
     * @return User
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * Get maritalStatus
     *
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }
    
    /**
     * Set civility
     *
     * @param string $civility
     * @return User
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * Get civility
     *
     * @return string
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * Set phone
     *
     * @param string $phone
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

        return substr($this->phone,0,2).' '.substr($this->phone,2,2).' '.substr($this->phone,4,2).' '.substr($this->phone,6,2).' '.substr($this->phone,8,2);
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return User
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    public function __toString() {
        return $this->firstname.' '.$this->lastname;
    }

    public function hasAddress()
    {
        if($this->getAddress())
            return true;
        else
            return false;
    }



    public function hasAddress2()
    {
        if($this->getAddress2())
            return true;
        else
            return false;
    }



    /**
     * Set avatar
     *
     * @param \FLOT\MainBundle\Entity\Image $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }
    /**
     * Get avatar
     *
     * @return \FLOT\MainBundle\Entity\Image
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /** --------------------------------------- **/
    /** GESTION DES CREATED / DELETED / UPDATED **/
    /** --------------------------------------- **/
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setDeletedBy(User $deletedBy = null)
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }

    public function getDeletedBy()
    {
        return $this->deletedBy;
    }
}