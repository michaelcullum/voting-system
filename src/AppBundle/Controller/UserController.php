<?php

namespace AppBundle\Controller;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/users", name="user")
     */
    public function listAction(Request $request): Response
    {
        $users = $this->getUsers($request);

        return $this->render('default/index.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/users/create", name="user_create")
     */
    public function createAction(): Response
    {
        $response = $this->forward('FOSUserBundle:Registration:register');

        return $response;
    }

    /**
     * @Route("/users/{name}", name="user_profile")
     * @ParamConverter("user", options={"mapping": {"name": "username"}})
     */
    public function profileAction(Request $request, User $user): Response
    {
        $votes = $this->getUserVotes($request, $user);

        return $this->render(
            'default/index.html.twig',
            ['votes' => $votes, 'user' => $user,]
        );
    }

    /**
     * Get pagination object of users
     *
     * @param Request $request
     * @return Pagerfanta
     */
    protected function getUsers(Request $request): Pagerfanta
    {
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll();
        $paginator = new Pagerfanta(new ArrayAdapter($users));
        $paginator->setMaxPerPage(20);
        $paginator->setCurrentPage($request->query->get('page', 1), false, true);

        return $paginator;
    }

    /**
     * Get pagination object of user votes
     *
     * @param Request $request
     * @param User    $user
     * @return Pagerfanta
     */
    protected function getUserVotes(Request $request, User $user): Pagerfanta
    {
        $votes = $this->getDoctrine()
            ->getRepository('AppBundle:Votes') // TODO: We won't do this?
            ->getFilteredQueryBuilder(array('voter' => $user->getId()), true);
        $paginator = new Pagerfanta(new DoctrineORMAdapter($votes, true));
        $paginator->setMaxPerPage(20);
        $paginator->setCurrentPage($request->query->get('page', 1), false, true);

        return $paginator;
    }
}
