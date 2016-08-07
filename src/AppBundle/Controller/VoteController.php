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
        $polls = $this->getPolls($request);
        $current = $this->getCurrentPolls();

        return $this->render('default/index.html.twig', ['polls' => $polls, 'current' => $current]);
    }

    /**
     * Get an array of current polls (objects)
     *
     * @return array
     */
    protected function getCurrentPolls(): array
    {
        $currentPolls = $this->getDoctrine()
            ->getRepository('AppBundle:Poll')
            ->findByActive(true);

        return $currentPolls;
    }

    /**
     * Get pagination object of Polls
     *
     * @param Request $request
     * @return Pagerfanta
     */
    protected function getPolls(Request $request): Pagerfanta
    {
        $polls = $this->getDoctrine()
            ->getRepository('AppBundle:Poll')
            ->findAll();
        $paginator = new Pagerfanta(new ArrayAdapter($polls));
        $paginator->setMaxPerPage(20);
        $paginator->setCurrentPage($request->query->get('page', 1), false, true);

        return $paginator;
    }
}
