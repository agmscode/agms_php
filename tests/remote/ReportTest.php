<?php

namespace Agms;

require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

use PHPUnit_Framework_TestCase;
use \Agms\Report;

class ReportTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->report = new Report();
    }

    public function testReportClassAssignment()
    {
        $this->assertTrue($this->report instanceof Report);
    }

    public function testSuccessfulTransactionAPI()
    {
        $params = array(
            'start_date' => '2015-03-25',
            'end_date' => '2015-03-31'
        );
        $result = $this->report->listTransactions($params);
        $this->assertTrue(is_array($result));
    }

    public function testSuccessfulSAFEAPI()
    {
        $params = array(
            'start_date' => '2015-03-25',
            'end_date' => '2015-03-31'
        );
        $result = $this->report->listSAFEs($params);
        $this->assertTrue(is_array($result));
    }
}