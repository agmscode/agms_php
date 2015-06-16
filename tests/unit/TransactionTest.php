<?php

namespace Agms;

require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

use PHPUnit_Framework_TestCase;
use \Mockery as m;
use \Agms\Transaction;

class TransactionTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->agms = new Transaction();

    }

    public function tearDown()
    {
        m::close();
    }

    public function testTransactionClassAssignment()
    {
        $this->assertTrue($this->agms instanceof Transaction);
    }
}