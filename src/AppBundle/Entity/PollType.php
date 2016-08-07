<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PollType.
 *
 * @ORM\Table(name="poll_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PollTypeRepository")
 */
class PollType
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Poll", mappedBy="pollType")
     */
    private $polls;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->polls = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return PollType
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Add poll.
     *
     * @param \AppBundle\Entity\Poll $poll
     *
     * @return PollType
     */
    public function addPoll(\AppBundle\Entity\Poll $poll)
    {
        $this->polls[] = $poll;

        return $this;
    }

    /**
     * Remove poll.
     *
     * @param \AppBundle\Entity\Poll $poll
     */
    public function removePoll(\AppBundle\Entity\Poll $poll)
    {
        $this->polls->removeElement($poll);
    }

    /**
     * Get polls.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPolls()
    {
        return $this->polls;
    }
}
