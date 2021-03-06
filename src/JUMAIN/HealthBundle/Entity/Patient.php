<?php

namespace JUMAIN\HealthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use \DateTime;

/**
 * Patient
 *
 * @ORM\Table(name="patient")
 * @ORM\Entity(repositoryClass="JUMAIN\HealthBundle\Repository\PatientRepository")
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ExclusionPolicy("all")
 */
class Patient
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="FullName", type="string", length=255, unique=true, nullable=true)
     * @Expose
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="Sex", type="string", length=30, nullable=true)
     * @Expose
     */
    private $sex;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateOfBirth", type="date", nullable=true)
     * @Expose
     */
    private $dateOfBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="UniqueNumber", type="string", length=255, nullable=true)
     * @Expose
     */
    private $uniqueNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="Residence", type="string", length=255, nullable=true)
     * @Expose
     */
    private $residence;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreatedAt", type="datetime", nullable=true)
     * @Expose
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="UpdatedAt", type="datetime", nullable=true)
     * @Expose
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="MedicalDetail", mappedBy="patient")
     * @Expose
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
     * @ORM\PrePersist
     *
     * @return Patient
     */
    public function setUniqueNumber()
    {
        //DateTime::createFromFormat('U.u', microtime(TRUE));
        //$today = new \DateTime("now");
        $today = DateTime::createFromFormat('U.u', microtime(TRUE));
        $yr = $today->format('Y');
        $mth = $today->format('m');
        $dy = $today->format('d');
        $hr = $today->format('H');
        $min = $today->format('i');
        $secs = $today->format('s');
        $msecs = $today->format('u');
        

        $uniqueNumber = "jum_vacc_" . $yr . $mth . $dy . $hr . $min . $secs . $msecs;

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
     * @ORM\PrePersist
     *
     * @return Patient
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime('now');

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
     * @ORM\PrePersist
     * @ORM\PostUpdate
     *
     * @return Patient
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');

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
