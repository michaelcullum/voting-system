<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\AppBundle\Entity\User;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class UserController extends Controller
{
    /**
     * @Template()
     * @Route("/users", name="user")
     */
	public function listAction(): Response
	{
		$users = $this->getUsers($request);

		return $this->render('default/index.html.twig', ['users' => $users]);
	}

	/**
	 * @Route("/users/create", name="user_create")
     * @Security("has_role('ROLE_ADMIN')")
	 */
	public function createAction(): Response
	{
		$response = $this->forward('FOSUserBundle:Registration:register');

		return $response;
	}

    /**
     * @Template()
     * @Route("/users/{name}", name="user_profile")
     * @ParamConverter("user", options={"mapping": {"name": "username"}})
     */
    public function profileAction(Request $request, User $user): Response
    {
        $votes = $this->getUserVotes($request, $user);

        return array(
            'votes' => $votes,
            'user' => $user,
        );
    }

    /**
     * @param Request $request
     *
     * @return Pagerfanta
     */
    protected function getUsers(Request $request): Pagerfanta
    {
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User');
        $paginator = new Pagerfanta(new DoctrineORMAdapter($users, true));
        $paginator->setMaxPerPage(20);
        $paginator->setCurrentPage($request->query->get('page', 1), false, true);

        return $paginator;
    }

    /**
     * @param Request $request
     * @param User $user
     *
     * @return Pagerfanta
     */
    protected function getUserVotes(Request $request, User $user): Pagerfanta
    {
        $votes = $this->getDoctrine()
            ->getRepository('AppBundle:VoteInstances') // TODO: We won't do this?
            ->getFilteredQueryBuilder(array('voter' => $user->getId()), true);
        $paginator = new Pagerfanta(new DoctrineORMAdapter($votes, true));
        $paginator->setMaxPerPage(20);
        $paginator->setCurrentPage($request->query->get('page', 1), false, true);

        return $paginator;
    }
}
