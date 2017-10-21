<?php

namespace JUMAIN\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JUMAIN\AdminBundle\Entity\User;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * AdminUser
 *
 * @ORM\Table(name="admin_user")
 * @ORM\Entity(repositoryClass="JUMAIN\AdminBundle\Repository\AdminUserRepository")
 * @UniqueEntity(fields = "username", targetClass = "JUMAIN\AdminBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "JUMAIN\AdminBundle\Entity\User", message="fos_user.email.already_used")
 */
class AdminUser extends User
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
     * @ORM\Column(name="FullName", type="string", length=255)
     */
    private $fullName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateAdded", type="datetime", nullable=true)
     */
    private $dateAdded;


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
     * Set fullName
     *
     * @param string $fullName
     *
     * @return AdminUser
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return AdminUser
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
