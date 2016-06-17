<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="app_user_index"
     * )
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        /*
         *  Inserts "manuales"

        $user = new User();
        $user->setEmail('prova@prova.com');
        $user->setUsername('test');

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);

        $user = new User();
        $user->setEmail('jc@prova.com');
        $user->setUsername('jc');

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);


        $em->flush();
        */

        $repository = $this->getDoctrine()->getRepository('AppBundle:User');

        $users = $repository->findAll();

        return $this->render(':user:index.html.twig', array('users' => $users));
    }

    /**
     * @Route(
     *     path="/add/",
     *     name="app_user_add"
     * )
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');

        $users = $repository->findAll();

        return $this->render(':user:add.html.twig', array('users' => $users));
    }
        
    
    
}
