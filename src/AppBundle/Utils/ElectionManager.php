<?php

namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Poll;

class ElectionManager
{
    protected $entityManager;
    protected $pollRepo;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->pollRepo = $this->entityManager->getRepository('AppBundle:Poll');
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
    	return getElectionResults($poll);
    }

    public function submitVotes(array $choices)
    {
        return;
    }

    public function getElectionPollVotes(Poll $poll): array
    {
    	return [];
    }

    public function getElectionResults(Poll $poll): array
    {
    	return [];
    }

    public function getElectionWinner(Poll $poll): AppBundle\Entity\Choice
    {
        return;
    }
}
