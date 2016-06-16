<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\CalculatorService;

class CalculatorController extends Controller
{
    /**
     * @Route(
     *     path = "/",
     *     name = "app_calculator_index"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render(':calculator:index.html.twig', array());
    }

    /**
     * @Route(
     *     path = "/form",
     *     name = "app_calculator_form"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sumAction()
    {
        return $this->render(':calculator:form.html.twig', array('action' => 'app_calculator_dosum'));
    }

    /**
     * @Route(
     *     path = "/doSum",
     *     name = "app_calculator_dosum"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dosumAction(Request $request)
    {
        $op1 = $request->request->get(op1);
        $op2 = $request->request->get(op2);

        $calculator = $this->get('calculator');
        
        return $this->render(':calculator:form.html.twig', array('action' => ''));
    }


}
