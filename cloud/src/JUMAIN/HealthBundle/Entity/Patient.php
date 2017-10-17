<?php

namespace JUMAIN\HealthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Expose;

/**
 * Patient
 *
 * @ORM\Table(name="patient")
 * @ORM\Entity(repositoryClass="JUMAIN\HealthBundle\Repository\PatientRepository")
 */
class Patient
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
     * @ORM\Column(name="FullName", type="string", length=255, unique=true, nullable=true)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="Sex", type="string", length=30, nullable=true)
     */
    private $sex;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateOfBirth", type="date", nullable=true)
     */
    private $dateOfBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="UniqueNumber", type="string", length=255, unique=true)
     */
    private $uniqueNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="Residence", type="string", length=255, nullable=true)
     */
    private $residence;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreatedAt", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="UpdatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="MedicalDetail", mappedBy="patient")
     *
     */
    private $detail;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detail = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fullName
     *
     * @param string $fullName
     *
     * @return Patient
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
     * Set sex
     *
     * @param string $sex
     *
     * @return Patient
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return Patient
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set uniqueNumber
     *
     * @param string $uniqueNumber
     *
     * @return Patient
     */
    public function setUniqueNumber($uniqueNumber)
    {
        $this->uniqueNumber = $uniqueNumber;

        return $this;
    }

    /**
     * Get uniqueNumber
     *
     * @return string
     */
    public function getUniqueNumber()
    {
        return $this->uniqueNumber;
    }

    /**
     * Set residence
     *
     * @param string $residence
     *
     * @return Patient
     */
    public function setResidence($residence)
    {
        $this->residence = $residence;

        return $this;
    }

    /**
     * Get residence
     *
     * @return string
     */
    public function getResidence()
    {
        return $this->residence;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Patient
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Patient
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add detail
     *
     * @param \JUMAIN\HealthBundle\Entity\MedicalDetail $detail
     *
     * @return Patient
     */
    public function addDetail(\JUMAIN\HealthBundle\Entity\MedicalDetail $detail)
    {
        $this->detail[] = $detail;

        return $this;
    }

    /**
     * Remove detail
     *
     * @param \JUMAIN\HealthBundle\Entity\MedicalDetail $detail
     */
    public function removeDetail(\JUMAIN\HealthBundle\Entity\MedicalDetail $detail)
    {
        $this->detail->removeElement($detail);
    }

    /**
     * Get detail
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetail()
    {
        return $this->detail;
    }
}
