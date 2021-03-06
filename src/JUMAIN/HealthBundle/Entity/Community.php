<?php

namespace JUMAIN\HealthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Community
 *
 * @ORM\Table(name="community")
 * @ORM\Entity(repositoryClass="JUMAIN\HealthBundle\Repository\CommunityRepository")
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ExclusionPolicy("all")
 */
class Community
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
     * @ORM\Column(name="CommunityName", type="string", length=255, nullable=true)
     * @Expose
     */
    private $communityName;

    /**
     * @var int
     *
     * @ORM\Column(name="MaleAbv10", type="integer", nullable=true)
     * @Expose
     */
    private $maleAbv10;

    /**
     * @var int
     *
     * @ORM\Column(name="FemBtw10N15", type="integer", nullable=true)
     * @Expose
     */
    private $femBtw10N15;

    /**
     * @var int
     *
     * @ORM\Column(name="ChildBel10", type="integer", nullable=true)
     * @Expose
     */
    private $childBel10;

    /**
     * @var int
     *
     * @ORM\Column(name="FemAbv15", type="integer", nullable=true)
     * @Expose
     */
    private $femAbv15;

    /**
     * @var bool
     *
     * @ORM\Column(name="current", type="boolean", nullable=true)
     * @Expose
     */
    private $current;

    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="community")
     * @Expose
     *
     */
    private $project;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreatedAt", type="datetime")
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
     * Constructor
     */
    public function __construct()
    {
        $this->project = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set communityName
     *
     * @param string $communityName
     *
     * @return Community
     */
    public function setCommunityName($communityName)
    {
        $this->communityName = $communityName;

        return $this;
    }

    /**
     * Get communityName
     *
     * @return string
     */
    public function getCommunityName()
    {
        return $this->communityName;
    }

    /**
     * Set maleAbv10
     *
     * @param integer $maleAbv10
     *
     * @return Community
     */
    public function setMaleAbv10($maleAbv10)
    {
        $this->maleAbv10 = $maleAbv10;

        return $this;
    }

    /**
     * Get maleAbv10
     *
     * @return integer
     */
    public function getMaleAbv10()
    {
        return $this->maleAbv10;
    }

    /**
     * Set femBtw10N15
     *
     * @param integer $femBtw10N15
     *
     * @return Community
     */
    public function setFemBtw10N15($femBtw10N15)
    {
        $this->femBtw10N15 = $femBtw10N15;

        return $this;
    }

    /**
     * Get femBtw10N15
     *
     * @return integer
     */
    public function getFemBtw10N15()
    {
        return $this->femBtw10N15;
    }

    /**
     * Set childBel10
     *
     * @param integer $childBel10
     *
     * @return Community
     */
    public function setChildBel10($childBel10)
    {
        $this->childBel10 = $childBel10;

        return $this;
    }

    /**
     * Get childBel10
     *
     * @return integer
     */
    public function getChildBel10()
    {
        return $this->childBel10;
    }

    /**
     * Set femAbv15
     *
     * @param integer $femAbv15
     *
     * @return Community
     */
    public function setFemAbv15($femAbv15)
    {
        $this->femAbv15 = $femAbv15;

        return $this;
    }

    /**
     * Get femAbv15
     *
     * @return integer
     */
    public function getFemAbv15()
    {
        return $this->femAbv15;
    }

    /**
     * Set current
     *
     * @param boolean $current
     *
     * @return Community
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
     * @ORM\PrePersist
     *
     * @return Community
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
     * @return Community
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
     * Add project
     *
     * @param \JUMAIN\HealthBundle\Entity\Project $project
     *
     * @return Community
     */
    public function addProject(\JUMAIN\HealthBundle\Entity\Project $project)
    {
        $this->project[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \JUMAIN\HealthBundle\Entity\Project $project
     */
    public function removeProject(\JUMAIN\HealthBundle\Entity\Project $project)
    {
        $this->project->removeElement($project);
    }

    /**
     * Get project
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProject()
    {
        return $this->project;
    }
}
