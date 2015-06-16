<?php

namespace Agms;

require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

use PHPUnit_Framework_TestCase;
use \Agms\HPP;

class HPPTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->hpp = new HPP();
    }

    public function testHPPClassAssignment()
    {
        $this->assertTrue($this->hpp instanceof HPP);
    }

    public function testSuccessfulHPPGetHash()
    {
        $params = array(
            'transaction_type'=> array('value' => 'sale'),
            'amount' => array( 'value' => '20.00'),
            'first_name' => array( 'setting' => 'required'),
            'last_name' => array( 'setting' => 'required'),
            'zip' => array( 'setting' => 'required'),
            'email' =>  array( 'setting' => 'required'),
            'hpp_format' =>  array( 'value' => '1'),
        );
        $result = $this->hpp->generate($params);
        $this->assertTrue(is_string($result['hash']));
    }

    public function testSuccessfulHPPGetLink()
    {
        $params = array(
            'transaction_type'=> array('value' => 'sale'),
            'amount' => array( 'value' => '20.00'),
            'first_name' => array( 'setting' => 'required'),
            'last_name' => array( 'setting' => 'required'),
            'zip' => array( 'setting' => 'required'),
            'email' =>  array( 'setting' => 'required'),
            'hpp_format' =>  array( 'value' => '1'),
        );
        $result = $this->hpp->generate($params);
        $this->assertTrue(is_string($result['hash']));
    }
}