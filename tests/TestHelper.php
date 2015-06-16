<?php
set_include_path(
    get_include_path() . PATH_SEPARATOR .
    realpath(dirname(__FILE__)) . '/../lib'
);

/*
 * Autoload Path
 */
require realpath(dirname(__FILE__)).'/../vendor/autoload.php';

/*
 * Load Settings
 */
use \Agms\Utility\Settings;

/*
 * Gateway settings
 */
Settings::$Api_Username = 'agmsdevdemo';
Settings::$Api_Password = 'nX1m*xa9Id';
Settings::$Api_Account = '1001789';
Settings::$Api_Key = 'b00f57326f8cf34bbb705a74b5fcbaa2b2f3e58076dc81f';
