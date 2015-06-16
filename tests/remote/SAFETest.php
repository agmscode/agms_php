<?php

namespace Agms;

require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

use PHPUnit_Framework_TestCase;
use \Agms\SAFE;

class SAFETest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->safe = new SAFE();
    }

    public function testSAFEClassAssignment()
    {
        $this->assertTrue($this->safe instanceof SAFE);
    }

    public function testSuccessfulSAFEAdd()
    {
        $params = array(
            'payment_type' => array('value' => 'creditcard'),
            'first_name' => array( 'value' => 'Joe'),
            'last_name' => array( 'value' => 'Smith'),
            'cc_number' => array( 'value' => '4111111111111111'),
            'cc_exp_date' => array( 'value' => '0520'),
            'cc_cvv' => array( 'value' => '123')
        );
        $result = $this->safe->add($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("SAFE Record added successfully. No transaction processed.", $result['response_message']);
    }

    public function testFailedSAFEAdd()
    {
        $params = array(
            'payment_type' => array('value' => 'creditcard'),
            'first_name' => array( 'value' => 'Joe'),
            'last_name' => array( 'value' => 'Smith'),
            'cc_number' => array( 'value' => '4111111111111111')
        );
        $result = $this->safe->add($params);
        $this->assertEquals(10, $result['response_code']);
        $this->assertEquals("Add to safe failed: Missing 'credit card' info.", $result['response_message']);
    }

    public function testSuccessfulSAFEUpdate()
    {
        $params = array(
            'payment_type' => array('value' => 'creditcard'),
            'first_name' => array( 'value' => 'Joe'),
            'last_name' => array( 'value' => 'Smith'),
            'cc_number' => array( 'value' => '4111111111111111'),
            'cc_exp_date' => array( 'value' => '0520'),
            'cc_cvv' => array( 'value' => '123')
        );
        $result = $this->safe->add($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("SAFE Record added successfully. No transaction processed.", $result['response_message']);

        $safe_id = $result['safe_id'];

        $params = array(
            'payment_type' => array('value' => 'creditcard'),
            'first_name' => array( 'value' => 'Joe'),
            'last_name' => array( 'value' => 'Smith'),
            'cc_number' => array( 'value' => '4111111111111111'),
            'cc_exp_date' => array( 'value' => '0520'),
            'cc_cvv' => array( 'value' => '123'),
            'safe_id' => array('value' => $safe_id)
        );

        $result = $this->safe->update($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("SAFE Record updated successfully. No transaction processed.", $result['response_message']);
    }

    public function testFailedSAFEUpdate()
    {
        $params = array(
            'payment_type' => array('value' => 'creditcard'),
            'first_name' => array( 'value' => 'Joe'),
            'last_name' => array( 'value' => 'Smith'),
            'cc_number' => array( 'value' => '4111111111111111'),
            'cc_exp_date' => array( 'value' => '0520'),
            'cc_cvv' => array( 'value' => '123')
        );
        $result = $this->safe->add($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("SAFE Record added successfully. No transaction processed.", $result['response_message']);

        $params = array(
            'payment_type' => array('value' => 'creditcard'),
            'first_name' => array( 'value' => 'Joe'),
            'last_name' => array( 'value' => 'Smith'),
            'cc_number' => array( 'value' => '4111111111111111'),
            'cc_exp_date' => array( 'value' => '0520'),
            'cc_cvv' => array( 'value' => '123')
        );

        $result = $this->safe->update($params);
        $this->assertEquals(10, $result['response_code']);
        $this->assertEquals("Update safe failed. No SAFE ID given.", $result['response_message']);
    }

    public function testSuccessfulSAFEDelete()
    {
        $params = array(
            'payment_type' => array('value' => 'creditcard'),
            'first_name' => array( 'value' => 'Joe'),
            'last_name' => array( 'value' => 'Smith'),
            'cc_number' => array( 'value' => '4111111111111111'),
            'cc_exp_date' => array( 'value' => '0520'),
            'cc_cvv' => array( 'value' => '123')
        );
        $result = $this->safe->add($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("SAFE Record added successfully. No transaction processed.", $result['response_message']);

        $safe_id = $result['safe_id'];

        $params = array(
            'safe_id' => array('value' => $safe_id)
        );

        $result = $this->safe->delete($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("SAFE record has been deactivated", $result['response_message']);
    }

    public function testFailedSAFEDelete()
    {
        $params = array(
            'payment_type' => array('value' => 'creditcard'),
            'first_name' => array( 'value' => 'Joe'),
            'last_name' => array( 'value' => 'Smith'),
            'cc_number' => array( 'value' => '4111111111111111'),
            'cc_exp_date' => array( 'value' => '0520'),
            'cc_cvv' => array( 'value' => '123')
        );
        $result = $this->safe->add($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("SAFE Record added successfully. No transaction processed.", $result['response_message']);

        $result = $this->safe->delete($params);
        $this->assertEquals(10, $result['response_code']);
        $this->assertEquals("Delete from safe failed. No SAFE ID given.", $result['response_message']);
    }


}