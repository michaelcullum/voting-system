<?php

namespace AppBundle\Utils;

use AppBundle\Entity\Poll;
use Doctrine\ORM\EntityManager;

class PollManager
{
    protected $entityManager;
    protected $pollRepo;
    protected $electionManager;

    /**
     * Constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, ElectionManager $electionManager)
    {
        $this->entityManager = $entityManager;
        $this->repo = $this->entityManager->getRepository('AppBundle:Poll');
        $this->electionManager = $electionManager;
    }

    /**
     * Get an array of current polls (objects).
     *
     * @return array
     */
    public function getCurrentPolls(): array
    {
        $currentPolls = $this->repo->findByActive(true);

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
        $polls = $this->repo->findAll();

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
     * @return AppBundle/Entity/Choice
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
