<?php

namespace JUMAIN\HealthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MedicalDetail
 *
 * @ORM\Table(name="medical_detail")
 * @ORM\Entity(repositoryClass="JUMAIN\HealthBundle\Repository\MedicalDetailRepository")
 */
class MedicalDetail
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Patient", inversedBy="detail", cascade={"persist"})
     * @ORM\JoinColumn(name="PatientId", referencedColumnName="id", nullable=true)
     */
    private $patient;

    /**
     * @var string
     *
     * @ORM\Column(name="VaccinationStatus", type="string", length=50, nullable=true)
     */
    private $vaccinationStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="VaccinationDate", type="datetime", nullable=true)
     */
    private $vaccinationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="EmployeeName", type="string", length=100, nullable=true)
     */
    private $employeeName;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="current", type="boolean", nullable=true)
     */
    private $current;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreatedAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="UpdatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;


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
     * Set vaccinationStatus
     *
     * @param string $vaccinationStatus
     *
     * @return MedicalDetail
     */
    public function setVaccinationStatus($vaccinationStatus)
    {
        $this->vaccinationStatus = $vaccinationStatus;

        return $this;
    }

    /**
     * Get vaccinationStatus
     *
     * @return string
     */
    public function getVaccinationStatus()
    {
        return $this->vaccinationStatus;
    }

    /**
     * Set vaccinationDate
     *
     * @param \DateTime $vaccinationDate
     *
     * @return MedicalDetail
     */
    public function setVaccinationDate($vaccinationDate)
    {
        $this->vaccinationDate = $vaccinationDate;

        return $this;
    }

    /**
     * Get vaccinationDate
     *
     * @return \DateTime
     */
    public function getVaccinationDate()
    {
        return $this->vaccinationDate;
    }

    /**
     * Set employeeName
     *
     * @param string $employeeName
     *
     * @return MedicalDetail
     */
    public function setEmployeeName($employeeName)
    {
        $this->employeeName = $employeeName;

        return $this;
    }

    /**
     * Get employeeName
     *
     * @return string
     */
    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return MedicalDetail
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set current
     *
     * @param boolean $current
     *
     * @return MedicalDetail
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Get current
     *
     * @return boolean
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return MedicalDetail
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
     * @return MedicalDetail
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
     * Set patient
     *
     * @param \JUMAIN\HealthBundle\Entity\Patient $patient
     *
     * @return MedicalDetail
     */
    public function setPatient(\JUMAIN\HealthBundle\Entity\Patient $patient = null)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return \JUMAIN\HealthBundle\Entity\Patient
     */
    public function getPatient()
    {
        return $this->patient;
    }
}
