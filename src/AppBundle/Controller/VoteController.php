<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Poll;
use AppBundle\Exception\InvalidSort;
use AppBundle\Utils\ElectionManager;
use AppBundle\Utils\PollManager;
use AppBundle\Utils\VotableManager;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VoteController extends Controller
{
	private $electionManager;
	private $pollManager;

	/**
	 * VoteController constructor.
	 *
	 * @param \AppBundle\Utils\PollManager     $pollManager
	 * @param \AppBundle\Utils\ElectionManager $electionManager
	 */
	public function __construct(PollManager $pollManager, ElectionManager $electionManager)
	{
		$this->pollManager = $pollManager;
		$this->electionManager = $electionManager;
	}

	/**
	 * @Route("/polls", name="polls_list")
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 */
	public function listAction(Request $request): Response
	{
		try {
			$sort = $request->request->has('sort') ? $sort = $request->get('sort') : null;
			$polls = $this->pollManager->getPolls($sort);
			$current = $this->pollManager->getPolls($sort, true);
		} catch ( InvalidSort $e ) {
			throw new NotFoundHttpException('This is an invalid sorting method');
		}

		$pollsPaginated = $this->paginate($request, $polls);

		return $this->render('default/index.html.twig', ['polls' => $pollsPaginated, 'current' => $current]);
	}

	/**
	 * Get pagination object of Polls.
	 *
	 * @param Request $request
	 *
	 * @return Pagerfanta
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 */
	protected function paginate(Request $request, array $items): Pagerfanta
	{
		$paginator = new Pagerfanta(new ArrayAdapter($items));

		$paginator->setMaxPerPage(20);

		try {
			$paginator->setCurrentPage($request->query->get('page', 1), false, true);
		} catch ( \PagerFanta\Exception\Exception $e ) {
			throw new NotFoundHttpException('Page not found');
		}

		return $paginator;
	}

	/**
	 * @Route("/poll/{id}", name="poll_view")
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 * @param \AppBundle\Entity\Poll                    $poll
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function viewAction(Request $request, Poll $poll): Response
	{
	}
}
