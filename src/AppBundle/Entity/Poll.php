<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Poll.
 *
 * @ORM\Table(name="polls")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PollRepository")
 */
class Poll
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime")
     */
    private $start;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="createdPolls")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     */
    private $creator;

    /**
     * @var \AppBundle\Entity\PollType
     *
     * @ORM\ManyToOne(targetEntity="PollType", inversedBy="polls")
     * @ORM\JoinColumn(name="poll_type_id", referencedColumnName="id")
     */
    private $pollType;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Vote", mappedBy="poll")
     */
    private $votes;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Choice")
     */
    private $choices;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \AppBundle\Entity\Choice
     *
     * @ORM\ManyToOne(targetEntity="Choice")
     * @ORM\JoinColumn(name="burden_id", referencedColumnName="id")
     */
    private $burden;

    // Collection of Users who were eligible to vote
    private $eligibleVoters;

    // Number of winners. Nullable as elections only
    private $winners;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->votes = new ArrayCollection();
        $this->choices = new ArrayCollection();
        $this->start = new \DateTime();
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
     * Get name.
     *
     * @return string
     */
	public function getName(): string
	{
		return $this->name;
	}

	/**
     * Set name.
     *
     * @param string $name
     *
     * @return Poll
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get start.
     *
     * @return \DateTime
     */
	public function getStart(): DateTime
    {
	    return $this->start;
    }

    /**
     * Set start.
     *
     * @param \DateTime $start
     *
     * @return Poll
     */
    public function setStart(\DateTime $start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
	public function getDescription(): string
    {
	    return $this->description;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Poll
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get creator.
     *
     * @return \AppBundle\Entity\User
     */
	public function getCreator(): \AppBundle\Entity\User
    {
	    return $this->creator;
    }

    /**
     * Set creator.
     *
     * @param \AppBundle\Entity\User $creator
     *
     * @return Poll
     */
    public function setCreator(\AppBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Add vote.
     *
     * @param \AppBundle\Entity\Vote $vote
     *
     * @return Poll
     */
    public function addVote(\AppBundle\Entity\Vote $vote)
    {
        $this->votes[] = $vote;

        return $this;
    }

    /**
     * Remove vote.
     *
     * @param \AppBundle\Entity\Vote $vote
     */
    public function removeVote(\AppBundle\Entity\Vote $vote)
    {
        $this->votes->removeElement($vote);
    }

    /**
     * Get votes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * Add choice.
     *
     * @param \AppBundle\Entity\Choice $choice
     *
     * @return Poll
     */
    public function addChoice(\AppBundle\Entity\Choice $choice)
    {
        $this->choices[] = $choice;

        return $this;
    }

    /**
     * Remove choice.
     *
     * @param \AppBundle\Entity\Choice $choice
     */
    public function removeChoice(\AppBundle\Entity\Choice $choice)
    {
        $this->choices->removeElement($choice);
    }

    /**
     * Get choices.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * Get pollType.
     *
     * @return \AppBundle\Entity\PollType
     */
	public function getPollType()
	{
		return $this->pollType;
	}

	/**
     * Set pollType.
     *
     * @param \AppBundle\Entity\PollType $pollType
     *
     * @return Poll
     */
    public function setPollType(\AppBundle\Entity\PollType $pollType = null)
    {
        $this->pollType = $pollType;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
	public function getActive(): bool
    {
	    return $this->active;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return Poll
     */
    public function setActive(bool $active)
    {
        $this->active = $active;

        return $this;
    }
}
