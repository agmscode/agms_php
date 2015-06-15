<?php

// Include settings and Agms file for code setup
require('lib/Agms/Utility/Settings.php');
require('lib/Agms/Agms.php');

/**
 * Modify this path to be the absolute location of your AGMS PHP Library folder ("AGMS")
 * By default, this path is automatically set to be the path of the PHP file including init.php
 **/
\Agms\Utility\Settings::$Path_To_Agms_Folder =  dirname(__FILE__) . '/lib/Agms/';


/**
 * Setting Debug as true will enable trace options and output errors and exceptions for development purposes
 * DO NOT enable this for production use
 **/
\Agms\Utility\Settings::$Debug = true;


/**
 * Setting Verbose as true will output raw request/responses for development purposes
 * DO NOT enable this for production use
 **/
\Agms\Utility\Settings::$Verbose = true;


/**
 * These will act as default values for all API connections
 * These can optionally be overriden when instantiating a new API object
 **/
\Agms\Utility\Settings::$Api_Username = 'your username';
\Agms\Utility\Settings::$Api_Password = 'your password';
\Agms\Utility\Settings::$Api_Account = 'your account number';
\Agms\Utility\Settings::$Api_Key = 'your api key';


/**
 * Your identifier for what service, website, or app is sending this request
 * UA string is stored with each transaction, so you can determine where it came from and what version of code it was using
 * i.e. "My Web App 1.2"
 **/
\Agms\Utility\Settings::$Ua_String = 'AGMS PHP Library Sample Code';

/**
 * Default HPP Template to use for generating links
 * Valid options are TEMPLATE_1 and TEMPLATE_2.  If invalid option or no option specified, TEMPLATE_2 will be used
 * Is overridden if an HPP Format parameter is provided as part of HPP generation request 
 **/
\Agms\Utility\Settings::$Hpp_Template = 'TEMPLATE_2';

/**
 * Personalize Custom Fieldnames
 * Define your own names for custom fields based on how you've configured them in the gateway for easier code readability
 * Keep in mind that some keywords are reserved and in use for other fields
 **/
\Agms\Utility\Settings::$Custom_Name_1 = 'your_custom_field_name_1';
\Agms\Utility\Settings::$Custom_Name_2 = 'your_custom_field_name_2';
\Agms\Utility\Settings::$Custom_Name_3 = 'your_custom_field_name_3';
\Agms\Utility\Settings::$Custom_Name_4 = 'your_custom_field_name_4';
\Agms\Utility\Settings::$Custom_Name_5 = 'your_custom_field_name_5';
\Agms\Utility\Settings::$Custom_Name_6 = 'your_custom_field_name_6';
\Agms\Utility\Settings::$Custom_Name_7 = 'your_custom_field_name_7';
\Agms\Utility\Settings::$Custom_Name_8 = 'your_custom_field_name_8';
\Agms\Utility\Settings::$Custom_Name_9 = 'your_custom_field_name_9';
\Agms\Utility\Settings::$Custom_Name_10 = 'your_custom_field_name_10';

/**
 * Transaction Amount Lower and Upper Limits
 * To help deter fraud or damage resulting from a programming error, set realistic upper and lower limits for transaction amounts
 * These only validate on amount fields used in actual transactions, reporting parameters are not limited by these
 **/
\Agms\Utility\Settings::$Minimum_Amount = 0.00;
\Agms\Utility\Settings::$Maximum_Amount = 10000.00;


/**
 * ********************************************************************
 * ****************** Do not modify beyond this point *****************
 * ********************************************************************
 **/

if (\Agms\Utility\Settings::$Debug) {
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
}

/**
 * API Transport Method
 * Valid options are SOAPCLIENT or CURL
 * For compatibility with all APIs, we fix as CURL
 * SOAPClient is not fully supported for all APIs in this library
 **/
\Agms\Utility\Settings::$Transport_Method = 'CURL';


// Utilities
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Utility/Connect.php');

// Requests
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Request/Request.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Request/HPPRequest.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Request/RecurringRequest.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Request/ReportRequest.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Request/SAFERequest.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Request/TransactionRequest.php');

// Response
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Response/Response.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Response/HPPResponse.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Response/InvoicingResponse.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Response/RecurringResponse.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Response/ReportResponse.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Response/SAFEResponse.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Response/TransactionResponse.php');

// Exceptions
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/AgmsException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/AuthenticationException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/AuthorizationException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/ClientErrorException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/ConfigurationException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/ConnectionException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/DownForMaintenanceException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/InvalidParameterException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/InvalidRequestException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/NotFoundException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/RequestValidationException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/ResponseException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/ServerErrorException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/SSLCertificateException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/UnexpectedException.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Exception/UpgradeRequiredException.php');


// API Objects
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'HPP.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Invoicing.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Recurring.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Report.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'SAFE.php');
require(\Agms\Utility\Settings::$Path_To_Agms_Folder . 'Transaction.php');



?>