<?php

namespace Elpiafo\SwitchUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Switch
 *
 * @ORM\Table(name="switchuser")
 * @ORM\Entity(repositoryClass="Elpiafo\SwitchUserBundle\Repository\SwitchUserRepository")
 */
class SwitchUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Grantor user allows granted user
     * @ORM\ManyToOne(targetEntity="Symfony\Component\Security\Core\User\UserInterface", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $grantor;

    /**
     * Granted user is allowed by grantor user
     * @ORM\ManyToOne(targetEntity="Symfony\Component\Security\Core\User\UserInterface", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $granted;

    /**
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    protected $startDate;

    /**
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    protected $endDate;

    /**
     * @ORM\Column(name="active", type="boolean")
     */
    protected $active;

    public function getId()
    {
        return $this->id;
    }

    public function setGrantor($grantor)
    {
        $this->grantor = $grantor;
        return $this;
    }

    public function getGrantor()
    {
        return $this->grantor;
    }

    public function setGranted($granted)
    {
        $this->granted = $granted;
        return $this;
    }

    public function getGranted()
    {
        return $this->granted;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

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

    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    public function isActive()
    {
        return $this->active;
    }
}

