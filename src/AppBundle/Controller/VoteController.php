<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Poll;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VoteController extends Controller
{
    /**
     * @Route("/poll", name="polls_list")
     */
    public function listAction(Request $request): Response
    {
        $pollsManager = $this->get('app.poll_manager');

        $polls = $this->getPolls($request);
        $current = $pollsManager->getCurrentPolls();

        return $this->render('default/index.html.twig', ['polls' => $polls, 'current' => $current]);
    }

    /**
     * @Route("/poll/{id}", name="poll_view")
     */
    public function viewAction(Request $request, Poll $poll): Response
    {
        $pollsMetadata = $this->get('app.poll_manager');
    }

    /**
     * Get pagination object of Polls
     *
     * @param Request $request
     * @return Pagerfanta
     */
    protected function getPolls(Request $request): Pagerfanta
    {
        $polls = $this->get('app.poll_manager')->getAllPolls();
        $paginator = new Pagerfanta(new ArrayAdapter($polls));
        $paginator->setMaxPerPage(20);
        $paginator->setCurrentPage($request->query->get('page', 1), false, true);

        return $paginator;
    }
}
