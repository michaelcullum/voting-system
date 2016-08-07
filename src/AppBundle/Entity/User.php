<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Poll;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @ORM\OneToMany(targetEntity="Poll", mappedBy="creator")
     */
    private $createdPolls;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Vote", mappedBy="caster")
     */
    private $votes;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->createdPolls = new ArrayCollection();
        $this->votes = new ArrayCollection();
    }

    /**
     * Set name
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
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Add createdPoll
     *
     * @param \AppBundle\Entity\Poll $createdPoll
     *
     * @return User
     */
    public function addCreatedPoll(Poll $createdPoll)
    {
        $this->createdPolls[] = $createdPoll;

        return $this;
    }

    /**
     * Remove createdPoll
     *
     * @param \AppBundle\Entity\Poll $createdPoll
     */
    public function removeCreatedPoll(Poll $createdPoll)
    {
        $this->createdPolls->removeElement($createdPoll);
    }

    /**
     * Get createdPolls
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedPolls()
    {
        return $this->createdPolls;
    }

    /**
     * Add vote
     *
     * @param \AppBundle\Entity\Vote $vote
     *
     * @return User
     */
    public function addVote(Vote $vote)
    {
        $this->votes[] = $vote;

        return $this;
    }

    /**
     * Remove vote
     *
     * @param \AppBundle\Entity\Vote $vote
     */
    public function removeVote(Vote $vote)
    {
        $this->votes->removeElement($vote);
    }

    /**
     * Get votes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVotes()
    {
        return $this->votes;
    }
}
