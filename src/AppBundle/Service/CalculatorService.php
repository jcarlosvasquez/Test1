<?php
/**
 * Created by PhpStorm.
 * User: devteam
 * Date: 6/10/16
 * Time: 7:16 PM
 */

namespace AppBundle\Service;


class CalculatorService
{
    private $_op1;
    private $_op2;
    private $_result;

    public function __construct($_op1 = null, $_op2 = null)
    {
        $this->_op1 = $_op1;
        $this->_op2 = $_op2;
    }

    public function sum()
    {
        $this->_result = $this->_op1 + $this->_op2;
    }

    public function subtract()
    {
        $this->_result = $this->_op1 - $this->_op2;
    }

    public function multiply()
    {
        $this->_result = $this->_op1 * $this->_op2;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->_result;
    }

    /**
     * @param null $op1
     */
    public function setOp1($op1)
    {
        $this->_op1 = $op1;
    }

    /**
     * @param null $op2
     */
    public function setOp2($op2)
    {
        $this->_op2 = $op2;
    }
    
    
}