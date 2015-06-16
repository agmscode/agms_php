<?php

namespace Agms;

require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

use PHPUnit_Framework_TestCase;
use \Agms\Utility\Settings;

class Dummy extends Agms
{
    function __construct(){
        parent::__construct();
    }
}
class AgmsTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        Settings::$Api_Username = 'agmsdevdemo';
        Settings::$Api_Password = 'nX1m*xa9Id';
        Settings::$Api_Account = '1001789';
        Settings::$Api_Key = 'b00f57326f8cf34bbb705a74b5fcbaa2b2f3e58076dc81f';


    }

    public function testAgmsVersion()
    {
        $this->assertSame(Dummy::MAJOR, 0);
        $this->assertSame(Dummy::MINOR, 7);
        $this->assertSame(Dummy::TINY, 0);
    }

    public function testAgmsWhatCardType()
    {
        $agms = new Dummy();
        $cardTrunc = '345';
        $this->assertEquals($agms->whatCardType($cardTrunc), 'American Express');
    }

}