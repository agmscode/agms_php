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
Settings::$Api_Username = 'osdgithub';
Settings::$Api_Password = 'Ks1m32aF@';
Settings::$Api_Account = '1002186';
Settings::$Api_Key = 'accf69cefaeb1d19702e33b0a9bfc9f8f0ab3c065d937fc';

