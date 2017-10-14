<?php

namespace JUMAIN\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JUMAIN\AdminBundle\Entity\User;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * NormalUser
 *
 * @ORM\Table(name="normal_user")
 * @ORM\Entity(repositoryClass="JUMAIN\AdminBundle\Repository\NormalUserRepository")
 * @UniqueEntity(fields = "username", targetClass = "JUMAIN\AdminBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "JUMAIN\AdminBundle\Entity\User", message="fos_user.email.already_used")
 */
class NormalUser extends User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="JUMAIN\ConsumerBundle\Entity\Consumer", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(name="ConsumerID", referencedColumnName="id", nullable=true)
     */
    private $consumer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateAdded", type="date", nullable=true)
     */
    private $dateAdded;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        /*if (!$this->id){
            $this->dateAdded = new \DateTime;
        }
        */
        $this->consumer = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set parishionerId
     *
     * @param integer $parishionerId
     *
     * @return NormalUser
     */
    public function setParishionerId($parishionerId)
    {
        $this->parishionerId = $parishionerId;

        return $this;
    }

    /**
     * Get parishionerId
     *
     * @return int
     */
    public function getParishionerId()
    {
        return $this->parishionerId;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return NormalUser
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set consumer
     *
     * @param \JUMAIN\ConsumerBundle\Entity\Consumer $consumer
     *
     * @return NormalUser
     */
    public function setConsumer(\JUMAIN\ConsumerBundle\Entity\Consumer $consumer = null)
    {
        $this->consumer = $consumer;

        return $this;
    }

    /**
     * Get consumer
     *
     * @return \JUMAIN\ConsumerBundle\Entity\Consumer
     */
    public function getConsumer()
    {
        return $this->consumer;
    }
}
