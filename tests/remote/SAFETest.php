<?php

namespace Agms;

require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

use PHPUnit_Framework_TestCase;
use \Agms\SAFE;
use Agms\Exception\ResponseException;


class SAFETest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();


    }

    public function testSAFEClassAssignment()
    {
        $this->safe = new SAFE();
        $this->assertTrue($this->safe instanceof SAFE);
    }

    public function testSuccessfulSAFEAdd()
    {
        $this->safe = new SAFE();
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
        $this->safe = new SAFE();
        $params = array(
            'payment_type' => array('value' => 'creditcard'),
            'first_name' => array( 'value' => 'Joe'),
            'last_name' => array( 'value' => 'Smith'),
            'cc_number' => array( 'value' => '4111111111111111')
        );
        try {
            $this->safe->add($params);
        } catch (ResponseException $e) {
            $args =$e->getTrace();
            $args = $args[0]['args'][0];
            $this->assertEquals(3, (string) $args->STATUS_CODE);
            $this->assertEquals("SAFE Record failed to add successfully.  No transaction processed. Adding a SAFE record of type 'creditcard' requires a CCExpDate|", (string) $args->STATUS_MSG);
        }
    }

    public function testSuccessfulSAFEUpdate()
    {
        $this->safe = new SAFE();
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
            'safe_id' => array( 'value' => $safe_id)
        );

        $result = $this->safe->update($params);
        
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("SAFE Record updated successfully. No transaction processed.", $result['response_message']);
    }

    public function testFailedSAFEUpdate()
    {
        $this->safe = new SAFE();
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
        try {
            $this->safe->update($params);
        } catch (ResponseException $e) {
            $args =$e->getTrace();
            $args = $args[0]['args'][0];
            $this->assertEquals(3, (string) $args->STATUS_CODE);
            $this->assertEquals("SAFE Record failed to update successfully.  No transaction processed. ", (string) $args->STATUS_MSG);
        }
    }

    public function testSuccessfulSAFEDelete()
    {
        $this->safe = new SAFE();
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
        $this->safe = new SAFE();
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
        try {
            $this->safe->delete($params);
        } catch (ResponseException $e) {
            $args =$e->getTrace();
            $args = $args[0]['args'][0];
            $this->assertEquals(10, (string) $args->STATUS_CODE);
            $this->assertEquals("Validation Error.  SAFE_ID is required. ", (string) $args->STATUS_MSG);
        }

    }


}