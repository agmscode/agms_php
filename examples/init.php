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
 * These will act as default values for all API connections
 * These can optionally be overriden when instantiating a new API object
 **/
// Settings::$Api_Username = 'your username';
// Settings::$Api_Password = 'your password';
// Settings::$Api_Account = 'your account number';
// Settings::$Api_Key = 'your api key';


Settings::$Api_Username = 'osdgithub';
Settings::$Api_Password = 'Ks1m32aF@';
Settings::$Api_Account = '1002186';
Settings::$Api_Key = 'accf69cefaeb1d19702e33b0a9bfc9f8f0ab3c065d937fc';

/**
 * Setting Debug as true will enable trace options and output errors and exceptions for development purposes
 * DO NOT enable this for production use
 **/
Settings::$Debug = true;


/**
 * Setting Verbose as true will output raw request/responses for development purposes
 * DO NOT enable this for production use
 **/
Settings::$Verbose = true;



/**
 * Your identifier for what service, website, or app is sending this request
 * UA string is stored with each transaction, so you can determine where it came from and what version of code it was using
 * i.e. "My Web App 1.2"
 **/
Settings::$Ua_String = 'AGMS PHP Library Sample Code';

/**
 * Default HPP Template to use for generating links
 * Valid options are TEMPLATE_1 and TEMPLATE_2.  If invalid option or no option specified, TEMPLATE_2 will be used
 * Is overridden if an HPP Format parameter is provided as part of HPP generation request 
 **/
Settings::$Hpp_Template = 'TEMPLATE_2';

/**
 * Personalize Custom Fieldnames
 * Define your own names for custom fields based on how you've configured them in the gateway for easier code readability
 * Keep in mind that some keywords are reserved and in use for other fields
 **/
Settings::$Custom_Name_1 = 'your_custom_field_name_1';
Settings::$Custom_Name_2 = 'your_custom_field_name_2';
Settings::$Custom_Name_3 = 'your_custom_field_name_3';
Settings::$Custom_Name_4 = 'your_custom_field_name_4';
Settings::$Custom_Name_5 = 'your_custom_field_name_5';
Settings::$Custom_Name_6 = 'your_custom_field_name_6';
Settings::$Custom_Name_7 = 'your_custom_field_name_7';
Settings::$Custom_Name_8 = 'your_custom_field_name_8';
Settings::$Custom_Name_9 = 'your_custom_field_name_9';
Settings::$Custom_Name_10 = 'your_custom_field_name_10';

/**
 * Transaction Amount Lower and Upper Limits
 * To help deter fraud or damage resulting from a programming error, set realistic upper and lower limits for transaction amounts
 * These only validate on amount fields used in actual transactions, reporting parameters are not limited by these
 **/
Settings::$Minimum_Amount = 0.00;
Settings::$Maximum_Amount = 10000.00;


/**
 * ********************************************************************
 * ****************** Do not modify beyond this point *****************
 * ********************************************************************
 **/

if (Settings::$Debug) {
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
}

/**
 * API Transport Method
 * Valid options are SOAPCLIENT or CURL
 * For compatibility with all APIs, we fix as CURL
 * SOAPClient is not fully supported for all APIs in this library
 **/
Settings::$Transport_Method = 'CURL';


?>