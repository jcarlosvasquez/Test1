<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
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
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        return $this->render(':user:form.html.twig',
            [
                'form'  => $form->createView(),
                'action' => $this->generateUrl('app_user_doCreate')
            ]
        );
    }

    /**
     * @Route(
     *     path = "/docreate",
     *     name = "app_user_doCreate"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function doCreateAction(Request $request)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('message', 'The user has been added');
            return $this->redirect($this->generateUrl('app_user_index'), 301);
        }

        $this->addFlash('message', 'Review your data');

        return $this->render(':user:form.html.twig',
            [
                'form'  => $form->createView(),
                'action' => $this->generateUrl('app_user_doCreate')
            ]
        );
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

        $form = $this->createForm(UserType::class, $user);

        return $this->render(':user:form.html.twig',
            [
                'form'  => $form->createView(),
                'action' => $this->generateUrl('app_user_doUpdate', ['id' => $id])
            ]
        );
    }

    /**
     * @Route(
     *     path = "/doupdate/{id}",
     *     name = "app_user_doUpdate"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function doUpdateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isValid()){
            $em->flush();
            $this->addFlash('message', 'The user has been updated');
            return $this->redirect($this->generateUrl('app_user_index'), 301);
        }
        $this->addFlash('message', 'Review your data');

        return $this->render(':user:form.html.twig',
            [
                'form'  => $form->createView(),
                'action' => $this->generateUrl('app_user_doUpdate', ['id' => $id])
            ]
        );
    }
}
