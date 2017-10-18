<?php

namespace JUMAIN\HealthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="JUMAIN\HealthBundle\Repository\ProjectRepository")
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ExclusionPolicy("all")
 */
class Project
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
     * @ORM\Column(name="ProjectName", type="string", length=255, nullable=true)
     * @Expose
     */
    private $projectName;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     * @Expose
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Community", inversedBy="project", cascade={"persist"})
     * @ORM\JoinColumn(name="CommunityID", referencedColumnName="id", nullable=true)
     *
     * @Expose
     */
    private $community;

    /**
     * @var int
     *
     * @ORM\Column(name="NumOfFieldWorkers", type="integer", nullable=true)
     * @Expose
     */
    private $numOfFieldWorkers;

    /**
     * @var int
     *
     * @ORM\Column(name="TimeSpan", type="integer", nullable=true)
     * @Expose
     */
    private $timeSpan;

    /**
     * @var float
     *
     * @ORM\Column(name="Budget", type="float", nullable=true)
     * @Expose
     */
    private $budget;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ProjectStrtDate", type="datetime", nullable=true)
     * @Expose
     */
    private $projectStrtDate;

    /**
     * @var string
     *
     * @ORM\Column(name="ProjectStatus", type="string", length=50, nullable=true)
     * @Expose
     */
    private $projectStatus;

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
     * @ORM\PrePersist
     *
     * @return Project
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
     * @ORM\PostPersist
     *
     * @return Project
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

    /**
     * Set projectStatus
     *
     * @param string $projectStatus
     *
     * @return Project
     */
    public function setProjectStatus($projectStatus)
    {
        $this->projectStatus = $projectStatus;

        return $this;
    }

    /**
     * Get projectStatus
     *
     * @return string
     */
    public function getProjectStatus()
    {
        return $this->projectStatus;
    }
}
