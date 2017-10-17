<?php

namespace JUMAIN\HealthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Expose;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="JUMAIN\HealthBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="ProjectName", type="string", length=255, nullable=true)
     */
    private $projectName;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Community", inversedBy="project", cascade={"persist"})
     * @ORM\JoinColumn(name="CommunityID", referencedColumnName="id", nullable=true)
     */
    private $community;

    /**
     * @var int
     *
     * @ORM\Column(name="NumOfFieldWorkers", type="integer", nullable=true)
     */
    private $numOfFieldWorkers;

    /**
     * @var int
     *
     * @ORM\Column(name="TimeSpan", type="integer", nullable=true)
     */
    private $timeSpan;

    /**
     * @var float
     *
     * @ORM\Column(name="Budget", type="float", nullable=true)
     */
    private $budget;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ProjectStrtDate", type="datetime", nullable=true)
     */
    private $projectStrtDate;

    /**
     * @var string
     *
     * @ORM\Column(name="ProjectStatus", type="string", length=50, nullable=true)
     */
    private $projectStatus;

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
     * @ORM\OneToMany(targetEntity="MedicalDetail", mappedBy="project")
     *
     */
    private $patientDetail;



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
     * Set projectName
     *
     * @param string $projectName
     *
     * @return Project
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
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
     * Set numOfFieldWorkers
     *
     * @param integer $numOfFieldWorkers
     *
     * @return Project
     */
    public function setNumOfFieldWorkers($numOfFieldWorkers)
    {
        $this->numOfFieldWorkers = $numOfFieldWorkers;

        return $this;
    }

    /**
     * Get numOfFieldWorkers
     *
     * @return integer
     */
    public function getNumOfFieldWorkers()
    {
        return $this->numOfFieldWorkers;
    }

    /**
     * Set timeSpan
     *
     * @param integer $timeSpan
     *
     * @return Project
     */
    public function setTimeSpan($timeSpan)
    {
        $this->timeSpan = $timeSpan;

        return $this;
    }

    /**
     * Get timeSpan
     *
     * @return integer
     */
    public function getTimeSpan()
    {
        return $this->timeSpan;
    }

    /**
     * Set budget
     *
     * @param float $budget
     *
     * @return Project
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return float
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Project
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
     * @return Project
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
     * Set community
     *
     * @param \JUMAIN\HealthBundle\Entity\Community $community
     *
     * @return Project
     */
    public function setCommunity(\JUMAIN\HealthBundle\Entity\Community $community = null)
    {
        $this->community = $community;

        return $this;
    }

    /**
     * Get community
     *
     * @return \JUMAIN\HealthBundle\Entity\Community
     */
    public function getCommunity()
    {
        return $this->community;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->patientDetail = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set projectStrtDate
     *
     * @param \DateTime $projectStrtDate
     *
     * @return Project
     */
    public function setProjectStrtDate($projectStrtDate)
    {
        $this->projectStrtDate = $projectStrtDate;

        return $this;
    }

    /**
     * Get projectStrtDate
     *
     * @return \DateTime
     */
    public function getProjectStrtDate()
    {
        return $this->projectStrtDate;
    }

    /**
     * Add patientDetail
     *
     * @param \JUMAIN\HealthBundle\Entity\MedicalDetail $patientDetail
     *
     * @return Project
     */
    public function addPatientDetail(\JUMAIN\HealthBundle\Entity\MedicalDetail $patientDetail)
    {
        $this->patientDetail[] = $patientDetail;

        return $this;
    }

    /**
     * Remove patientDetail
     *
     * @param \JUMAIN\HealthBundle\Entity\MedicalDetail $patientDetail
     */
    public function removePatientDetail(\JUMAIN\HealthBundle\Entity\MedicalDetail $patientDetail)
    {
        $this->patientDetail->removeElement($patientDetail);
    }

    /**
     * Get patientDetail
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPatientDetail()
    {
        return $this->patientDetail;
    }
}
