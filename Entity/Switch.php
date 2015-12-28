<?php

namespace Elpiafo\SwitchUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Switch
 *
 * @ORM\Table(name="switch")
 * @ORM\Entity(repositoryClass="Elpiafo\SwitchUserBundle\Repository\SwitchRepository")
 */
class Switch
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
     * @var \stdClass
     *
     * @ORM\Column(name="grantor", type="object")
     */
    private $grantor;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="granted", type="object")
     */
    private $granted;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;


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
     * Set grantor
     *
     * @param \stdClass $grantor
     *
     * @return Switch
     */
    public function setGrantor($grantor)
    {
        $this->grantor = $grantor;

        return $this;
    }

    /**
     * Get grantor
     *
     * @return \stdClass
     */
    public function getGrantor()
    {
        return $this->grantor;
    }

    /**
     * Set granted
     *
     * @param \stdClass $granted
     *
     * @return Switch
     */
    public function setGranted($granted)
    {
        $this->granted = $granted;

        return $this;
    }

    /**
     * Get granted
     *
     * @return \stdClass
     */
    public function getGranted()
    {
        return $this->granted;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Switch
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Switch
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Switch
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }
}

