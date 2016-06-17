<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction()
    {
        return $this->render(':user:add.html.twig', array('action' => 'app_add_docreate'));
    }

    /**
     * @Route(
     *     path = "/docreate",
     *     name = "app_add_docreate"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function docreateAction(Request $request)
    {

        $user = new User();

        $user->setUsername($request->request->get('usuario'));
        $user->setEmail($request->request->get('correo'));

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);

        $em->flush();

        $this->addFlash('message', 'The user has been added');
        return $this->redirect($this->generateUrl('app_user_index'), 301);
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="app_user_delete"
     * )
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        $em->remove($user);
        $em->flush();

        $this->addFlash('message', 'The user has been removed');
        return $this->redirect($this->generateUrl('app_user_index'), 301);

    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="app_user_update"
     * )
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        return $this->render(':user:edit.html.twig',['user' => $user]);
        
    }

    /**
     * @Route(
     *     path = "doupdate",
     *     name = "app_user_doUpdate"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function doUpdateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($request->request->get('id'));

        $user->setUsername($request->request->get('username'));
        $user->setEmail($request->request->get('email'));

        $em->flush();

        $this->addFlash('message', 'The user has been updated');

        return $this->redirect($this->generateUrl('app_user_index'), 301);
    }
}
