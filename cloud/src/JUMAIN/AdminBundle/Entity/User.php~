<?php

namespace JUMAIN\AdminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 *
 * @ORM\Entity(repositoryClass="JUMAIN\AdminBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"admin_user" = "AdminUser", "normal_user" = "NormalUser"})
 *
 */
abstract class User extends BaseUser
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
     * @var string
     *
     * @ORM\Column(name="MPlainPass", type="string", length=100, nullable=true)
     */
    private $mPlainPass;

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
        if (!$this->id){
            $this->dateAdded = new \DateTime;
        }


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
     * Set mPlainPass
     *
     * @param string $mPlainPass
     *
     * @return User
     */
    public function setMPlainPass($mPlainPass)
    {
        $this->mPlainPass = $mPlainPass;

        return $this;
    }

    /**
     * Get mPlainPass
     *
     * @return string
     */
    public function getMPlainPass()
    {
        return $this->mPlainPass;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return User
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
}
