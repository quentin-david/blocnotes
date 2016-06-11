<?php

namespace QT\BlocnotesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intervention
 *
 * @ORM\Table(name="intervention")
 * @ORM\Entity(repositoryClass="QT\BlocnotesBundle\Repository\InterventionRepository")
 */
class Intervention
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
     * @ORM\Column(name="num_di", type="string", length=40)
     */
    private $numDi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_intervention", type="datetime", nullable=true)
     */
    private $dateIntervention;


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
     * Set numDi
     *
     * @param string $numDi
     *
     * @return TopicIntervention
     */
    public function setNumDi($numDi)
    {
        $this->numDi = $numDi;

        return $this;
    }

    /**
     * Get numDi
     *
     * @return string
     */
    public function getNumDi()
    {
        return $this->numDi;
    }

    /**
     * Set dateIntervention
     *
     * @param \DateTime $dateIntervention
     *
     * @return TopicIntervention
     */
    public function setDateIntervention($dateIntervention)
    {
        $this->dateIntervention = $dateIntervention;

        return $this;
    }

    /**
     * Get dateIntervention
     *
     * @return \DateTime
     */
    public function getDateIntervention()
    {
        return $this->dateIntervention;
    }
}
