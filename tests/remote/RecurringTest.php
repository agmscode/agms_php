<?php

namespace Agms;

require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

use Agms\Exception\ResponseException;
use PHPUnit_Framework_TestCase;
use \Agms\Recurring;

class RecurringTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->recurring = new Recurring();
    }

    public function testSAFEClassAssignment()
    {
        $this->assertTrue($this->recurring instanceof Recurring);
    }


}