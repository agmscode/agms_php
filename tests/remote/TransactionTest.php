<?php

namespace Agms;

require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

use Agms\Exception\ResponseException;
use PHPUnit_Framework_TestCase;
use \Agms\Transaction;

class TransactionTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->agms = new Transaction();

    }

    public function testTransactionClassAssignment()
    {
        $this->assertTrue($this->agms instanceof Transaction);
    }

    public function testTransactionProcess()
    {
        $params = array(
            'transaction_type' => 'sale',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertTrue($this->agms instanceof Transaction);
        $this->assertTrue(is_array($result));
    }

    public function testSuccessfulSale()
    {
        $params = array(
            'transaction_type' => 'sale',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("Approved", $result['response_message']);
    }

    public function testFailedSale()
    {
        $params = array(
            'transaction_type' => 'sale',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1214',
        );
        $result = $this->agms->process($params);
        $this->assertEquals(2, $result['response_code']);
        $this->assertEquals("Declined", $result['response_message']);
    }

    public function testSuccessfulAuthorize()
    {
        $params = array(
            'transaction_type' => 'auth',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("Approved", $result['response_message']);
    }

    public function testFailedAuthorize()
    {
        $params = array(
            'transaction_type' => 'auth',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1214',
        );
        $result = $this->agms->process($params);
        $this->assertEquals(2, $result['response_code']);
        $this->assertEquals("Declined", $result['response_message']);
    }

    public function testSuccessfulCapture()
    {
        $params = array(
            'transaction_type' => 'auth',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("Approved", $result['response_message']);

        $transaction_id = $result['transaction_id'];

        $params = array(
            'transaction_type' => 'capture',
            'amount' => '20.00',
            'transaction_id' => $transaction_id
        );

        $result = $this->agms->process($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("Capture successful: Approved", $result['response_message']);
    }

    public function testPartialCapture()
    {
        $params = array(
            'transaction_type' => 'auth',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("Approved", $result['response_message']);


        $transaction_id = $result['transaction_id'];

        $params = array(
            'transaction_type' => 'capture',
            'amount' => '10.00',
            'transaction_id' => $transaction_id
        );

        $result = $this->agms->process($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("Capture successful: Approved", $result['response_message']);
    }

    public function testFailedCapture()
    {
        $params = array(
            'transaction_type' => 'auth',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertEquals(1, $result['response_code']);
        $this->assertEquals("Approved", $result['response_message']);

        $params = array(
            'transaction_type' => 'capture',
            'amount' => '20.00',
            'transaction_id' => '123'
        );

        try {
            $this->agms->process($params);
        } catch (ResponseException $e) {
            $args =$e->getTrace();
            $args = $args[0]['args'][0];
            $this->assertEquals(10, (string) $args->STATUS_CODE);
            $this->assertEquals("Transaction ID is not valid. Please double check your Transaction ID", (string) $args->STATUS_MSG);
        }

    }

    public function testSuccessfulRefund()
    {
        $params = array(
            'transaction_type' => 'sale',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertEquals($result['response_code'], 1);
        $this->assertEquals($result['response_message'], "Approved");

        $transaction_id = $result['transaction_id'];

        $params = array(
            'transaction_type' => 'refund',
            'amount' => '20.00',
            'transaction_id' => $transaction_id
        );

        $result = $this->agms->process($params);
        $this->assertEquals($result['response_code'], 1);
        $this->assertEquals($result['response_message'], "refund successful: Approved");
    }

    public function testPartialRefund()
    {
        $params = array(
            'transaction_type' => 'sale',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertEquals($result['response_code'], 1);
        $this->assertEquals($result['response_message'], "Approved");

        $transaction_id = $result['transaction_id'];

        $params = array(
            'transaction_type' => 'refund',
            'amount' => '10.00',
            'transaction_id' => $transaction_id
        );

        $result = $this->agms->process($params);
        $this->assertEquals($result['response_code'], 1);
        $this->assertEquals($result['response_message'], "refund successful: Approved");
    }

    public function testFailedRefund()
    {
        $params = array(
            'transaction_type' => 'sale',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertEquals($result['response_code'], 1);
        $this->assertEquals($result['response_message'], "Approved");

        $params = array(
            'transaction_type' => 'refund',
            'amount' => '20.00',
            'transaction_id' => '123'
        );

        try {
            $this->agms->process($params);
        } catch (ResponseException $e) {
            $args =$e->getTrace();
            $args = $args[0]['args'][0];
            $this->assertEquals(10, (string) $args->STATUS_CODE);
            $this->assertEquals("Transaction ID is not valid. Please double check your Transaction ID", (string) $args->STATUS_MSG);
        }
    }

    public function testSuccessfulVoid()
    {
        $params = array(
            'transaction_type' => 'sale',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertEquals($result['response_code'], 1);
        $this->assertEquals($result['response_message'], "Approved");

        $transaction_id = $result['transaction_id'];

        $params = array(
            'transaction_type' => 'void',
            'amount' => '20.00',
            'transaction_id' => $transaction_id
        );

        $result = $this->agms->process($params);
        $this->assertEquals($result['response_code'], 1);
        $this->assertEquals($result['response_message'], "void successful: Approved");
    }


    public function testFailedVoid()
    {
        $params = array(
            'transaction_type' => 'sale',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertEquals($result['response_code'], 1);
        $this->assertEquals($result['response_message'], "Approved");

        $params = array(
            'transaction_type' => 'refund',
            'amount' => '20.00',
            'transaction_id' => '123'
        );

        try {
            $this->agms->process($params);
        } catch (ResponseException $e) {
            $args =$e->getTrace();
            $args = $args[0]['args'][0];
            $this->assertEquals(10, (string) $args->STATUS_CODE);
            $this->assertEquals("Transaction ID is not valid. Please double check your Transaction ID", (string) $args->STATUS_MSG);
        }
    }

    public function testSuccessfulVerify()
    {
        $params = array(
            'transaction_type' => 'auth',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertEquals($result['response_code'], 1);
        $this->assertEquals($result['response_message'], "Approved");

        $transaction_id = $result['transaction_id'];

        $params = array(
            'transaction_type' => 'void',
            'amount' => '20.00',
            'transaction_id' => $transaction_id
        );

        $result = $this->agms->process($params);
        $this->assertEquals($result['response_code'], 1);
        $this->assertEquals($result['response_message'], "void successful: Approved");
    }


    public function testFailedVerify()
    {
        $params = array(
            'transaction_type' => 'auth',
            'amount' => '20.00',
            'cc_number' => '4111111111111111',
            'cc_exp_date' => '1220',
        );
        $result = $this->agms->process($params);
        $this->assertEquals($result['response_code'], 1);
        $this->assertEquals($result['response_message'], "Approved");

        $params = array(
            'transaction_type' => 'void',
            'amount' => '20.00',
            'transaction_id' => '123'
        );

        try {
            $this->agms->process($params);
        } catch (ResponseException $e) {
            $args =$e->getTrace();
            $args = $args[0]['args'][0];
            $this->assertEquals(10, (string) $args->STATUS_CODE);
            $this->assertEquals("Transaction ID is not valid. Please double check your Transaction ID", (string) $args->STATUS_MSG);
        }
    }
}