<?php

namespace AppBundle\Utils;

use AppBundle\Entity\{
	Choice, Poll
};
use Doctrine\Common\Persistence\ManagerRegistry;

class ElectionManager
{
	protected $doctrineRegistry;

	/**
	 * Constructor.
	 *
	 * @param \Doctrine\Common\Persistence\ManagerRegistry $doctrineRegistry
	 */
	public function __construct(ManagerRegistry $doctrineRegistry)
    {
	    $this->doctrineRegistry = $doctrineRegistry;
    }

    public function isElection(Poll $poll): boolean
    {
        return false;
    }

    public function getEligibleVoters(): array
    {
        return [];
    }

    public function calculateElectionResult(Poll $poll): array
    {
	    return $this->getElectionResults($poll);
    }

	public function getElectionResults(Poll $poll): array
	{
		return [];
	}

    public function submitVotes(array $choices)
    {
        return;
    }

    public function getElectionPollVotes(Poll $poll): array
    {
        return [];
    }

	public function getElectionWinner(Poll $poll): Choice
    {
        return;
    }
}
