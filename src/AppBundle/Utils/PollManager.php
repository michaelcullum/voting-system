<?php

namespace AppBundle\Utils;

use AppBundle\Entity\{
	Choice, Poll, PollType
};
use Doctrine\Common\Persistence\ManagerRegistry;

class PollManager
{
    protected $doctrineRegistry;
    protected $electionManager;

	/**
	 * Constructor.
	 *
	 * @param \Doctrine\Common\Persistence\ManagerRegistry $doctrineRegistry
	 * @param \AppBundle\Utils\ElectionManager             $electionManager
	 */
	public function __construct(ManagerRegistry $doctrineRegistry, ElectionManager $electionManager)
    {
        $this->doctrineRegistry = $doctrineRegistry;
        $this->electionManager = $electionManager;
    }

	public function getPolls($sort, boolean $current = false): array
	{
		if ($current) {
			return $this->getCurrentPolls();
		}
	}

    /**
     * Get an array of current polls (objects).
     *
     * @return array
     */
    public function getCurrentPolls(): array
    {
	    $currentPolls = $this->doctrineRegistry->getManager()->getRepository('AppBundle:Poll')->findByActive(true);

        return $currentPolls;
    }

    /**
     * Get an array of eligible votes.
     *
     * @param AppBundle/Entity/PollType $type
     *
     * @return array
     */
    public function getEligibleVoters(PollType $type): array
    {
        return [];
    }

    /**
     * Get an array of all polls (objects).
     *
     * @return array
     */
    public function getAllPolls(): array
    {
	    $polls = $this->doctrineRegistry->getManager()->getRepository('AppBundle:Poll')->findAll();

        return $polls;
    }

    /**
     * Get poll statistics.
     *
     * @param Poll $poll
     *
     * @return array
     */
    public function getPollStats(Poll $poll): array
    {
        // If Poll is election then reject

        // Get standard stats
        return [];
    }

	/**
	 * Get the result of the poll (in terms of a choice).
	 *
	 * @param Poll $poll
	 *
	 * @return \AppBundle\Entity\Choice
	 */
    public function getPollResult(Poll $poll): Choice
    {
        // If election then call Election Manager

        // Calculate winning choice
        return;
    }

    public function getStandardPollVotes(Poll $poll): array
    {
        return [];
    }

    public function markPollClosed(Poll $poll)
    {
        return;
    }
}
