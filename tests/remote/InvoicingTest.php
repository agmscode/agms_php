<?php

namespace Agms;

require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

use Agms\Exception\ResponseException;
use PHPUnit_Framework_TestCase;
use \Agms\Invoicing;

class InvoicingTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->invoicing = new Invoicing();
    }

    public function testSAFEClassAssignment()
    {
        $this->assertTrue($this->invoicing instanceof Invoicing);
    }


}