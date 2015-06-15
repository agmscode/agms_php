<?php

/**
 *
 * Settings Class
 *
 * @package    AGMS Gateway PHP Library
 * @subpackage AGMS
 * @copyright  2015 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Utility;

class Settings 
{

	/**
	 * Modify this path to be the absolute location of your AGMS PHP Library folder ("AGMS")
	 * Set this path at runtime
	 **/
	public static $Path_To_Agms_Folder = '/set/this/path/';

	/**
	 * Setting Debug as true will enable trace options and output errors and exceptions for development purposes
	 * DO NOT enable this for production use
	 **/
	public static $Debug = false;


	/**
	 * Setting Verbose as true will output raw request/responses for development purposes
	 * DO NOT enable this for production use
	 **/
	public static $Verbose = false;


	/**
	 * These will act as default values for all API connections
	 * These can optionally be overriden when instantiating a new API object
	 **/
	public static $Api_Username = 'your username';
	public static $Api_Password = 'your password';
	public static $Api_Account = 'your account';
	public static $Api_Key = 'your key';


	/**
	 * Your identifier for what service, website, or app is sending this request
	 * UA string is stored with each transaction, so you can determine where it came from and what version of code it was using
	 * i.e. "My Web App 1.2"
	 **/
	public static $Ua_String = 'AGMS PHP Code Library';


	/**
	 * Default HPP Template to use for generating links
	 * Valid options are TEMPLATE_1 and TEMPLATE_2.  If invalid option or no option specified, TEMPLATE_2 will be used
	 * Is overridden if an HPP Format parameter is provided as part of HPP generation request 
	 **/
	public static $Hpp_Template = 'TEMPLATE_2';


	/**
	 * Personalize Custom Fieldnames
	 * Define your own names for custom fields based on how you've configured them in the gateway for easier code readability
	 * Keep in mind that some keywords are reserved and in use for other fields
	 **/
	public static $Custom_Name_1 = 'your_custom_field_name_1';
	public static $Custom_Name_2 = 'your_custom_field_name_2';
	public static $Custom_Name_3 = 'your_custom_field_name_3';
	public static $Custom_Name_4 = 'your_custom_field_name_4';
	public static $Custom_Name_5 = 'your_custom_field_name_5';
	public static $Custom_Name_6 = 'your_custom_field_name_6';
	public static $Custom_Name_7 = 'your_custom_field_name_7';
	public static $Custom_Name_8 = 'your_custom_field_name_8';
	public static $Custom_Name_9 = 'your_custom_field_name_9';
	public static $Custom_Name_10 = 'your_custom_field_name_10';


	/**
	 * Transaction Amount Lower and Upper Limits
	 * To help deter fraud or damage resulting from a programming error, set realistic upper and lower limits for transaction amounts
	 * These only validate on amount fields used in actual transactions, reporting parameters are not limited by these
	 **/
	public static $Minimum_Amount = 0.00;
	public static $Maximum_Amount = 10000;


	/**
	 * API Transport Method
	 * Valid options are SOAPCLIENT or CURL
	 * For compatibility with all APIs, we fix as CURL
	 * SOAPClient is not fully supported for all APIs in this library
	 **/
	public static $Transport_Method = 'CURL';



	/************ Static Functions ************/
	public static function verifyEnvironment() 
	{

		// Verify that PHP is a high enough version to run
		if (version_compare(PHP_VERSION, '5.2.1', '<')) {
		    throw new \Agms\Exception\ConfigurationException('PHP version >= 5.2.1 required.');
		}


		// Verify that all necessary configuration constants have been defined
		$requiredSettings = array('Path_To_Agms_Folder', 'Api_Username', 'Api_Password','Api_Account','Api_Key', 'Transport_Method', 'Debug', 'Verbose', 'Ua_String', 'Hpp_Template');

		foreach ($requiredSettings AS $setting) {
		    if (!isset(self::$$setting)) {
		        throw new \Agms\Exception\ConfigurationException('Required constants are not defined (' . $setting . ').');
		    }
		} // requiredSettings


		// Verify that PHP has necessary packages installed
		if (self::$Transport_Method == 'SOAPCLIENT')
		    $requiredExtensions = array('libxml', 'openssl', 'soap');
		else
		    $requiredExtensions = array('xmlwriter', 'SimpleXML', 'openssl', 'dom', 'hash', 'curl');

		foreach ($requiredExtensions AS $ext) {
		    if (!extension_loaded($ext)) {
		        throw new \Agms\Exception\ConfigurationException('The AGMS PHP library requires the ' . $ext . ' extension.');
		    }
		}


		// Verify that developer has configured library specific to their account
		if ((self::$Path_To_Agms_Folder == '/set/this/path/') || (self::$Api_Username == 'your username') || (self::$Api_Password == 'your password') || (self::$Api_Account == 'your account') || (\Agms\Utility\Settings::$Api_Key == 'your key'))
		   throw new \Agms\Exception\ConfigurationException('The AGMS PHP library is still configured with installation defaults and will not function properly.  Please configure your path and API credentials for your server and try again.');



	} // verifyEnvironment()



} // Settings class
