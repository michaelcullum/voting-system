<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Choice;
use AppBundle\Entity\Poll;
use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table(name="votes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VoteRepository")
 */
class Vote
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
     * @var \Poll
     *
     * @ORM\ManyToOne(targetEntity="Poll", inversedBy="votes")
     * @ORM\JoinColumn(name="poll_id", referencedColumnName="id")
     */
    private $poll;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="votes")
     * @ORM\JoinColumn(name="caster_id", referencedColumnName="id")
     */
    private $caster;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;

    /**
     * @var \Choice
     *
     * @ORM\ManyToOne(targetEntity="Choice", inversedBy="votes")
     * @ORM\JoinColumn(name="choice_id", referencedColumnName="id")
     */
    private $choice;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Vote
     */
    public function setTime(\DateTimeInterface $time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime(): DateTime
    {
        return $this->time;
    }

    /**
     * Set poll
     *
     * @param \AppBundle\Entity\Poll $poll
     *
     * @return Vote
     */
    public function setPoll(Poll $poll = null)
    {
        $this->poll = $poll;

        return $this;
    }

    /**
     * Get poll
     *
     * @return \AppBundle\Entity\Poll
     */
    public function getPoll(): Poll
    {
        return $this->poll;
    }

    /**
     * Set caster
     *
     * @param \AppBundle\Entity\User $caster
     *
     * @return Vote
     */
    public function setCaster(User $caster = null)
    {
        $this->caster = $caster;

        return $this;
    }

    /**
     * Get caster
     *
     * @return \AppBundle\Entity\User
     */
    public function getCaster(): User
    {
        return $this->caster;
    }

    /**
     * Set choice
     *
     * @param \AppBundle\Entity\Choice $choice
     *
     * @return Vote
     */
    public function setChoice(Choice $choice = null)
    {
        $this->choice = $choice;

        return $this;
    }

    /**
     * Get choice
     *
     * @return \AppBundle\Entity\Choice
     */
    public function getChoice(): Choice
    {
        return $this->choice;
    }
}
