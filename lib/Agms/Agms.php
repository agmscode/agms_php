<?php

/**
 *
 * AGMS Superobject
 *
 * @package    AGMS Gateway PHP Library
 * @subpackage AGMS
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms;

abstract class Agms 
{

    /************ Object Constants ************/
    // Version data
    const MAJOR = 0;
    const MINOR = 8;
    const TINY = 0;

    const API = 3;


	/************ Object Variables ************/
    protected $username; // Gateway API username
    protected $password; // Gateway API password
    protected $account; // Gateway API Account Number
    protected $key; // Gateway API Key

    protected $api_url; // Location of web service - overriden in extended objects

    protected $op; // API method to be called

    protected $request = false; // Request object
    protected $response = false; // Response object


	/************ Constructor ************/

    /**
     * @ignore
     * @access protected
     */
    public function __construct($username='', $password='', $account='', $key='') 
    {

        // Make sure settings are set properly and library is ready to run
        \Agms\Utility\Settings::verifyEnvironment();

        if ($username && $password) {
            $this->username = \Agms\Utility\Connect::sanitize($username);
            $this->password = \Agms\Utility\Connect::sanitize($password);
            $this->account = \Agms\Utility\Connect::sanitize($account);
            $this->key = \Agms\Utility\Connect::sanitize($key);
        } else {
            $this->username = \Agms\Utility\Connect::sanitize(\Agms\Utility\Settings::$Api_Username);
            $this->password = \Agms\Utility\Connect::sanitize(\Agms\Utility\Settings::$Api_Password);
            $this->account = \Agms\Utility\Connect::sanitize(\Agms\Utility\Settings::$Api_Account);
            $this->key = \Agms\Utility\Connect::sanitize(\Agms\Utility\Settings::$Api_Key);
        }

    } // constructor()



	/************ Static Functions ************/

    /**
     *
     * @return string the current library version
     */
    public static function getLibraryVersion() 
    {

        return self::MAJOR . '.' . self::MINOR . '.' . self::TINY;

    } // getLibraryVersion()

    /**
     *
     * @return string the current API version
     */
    public static function getAPIVersion() 
    {

        return self::API;

    } // getAPIVersion()


	/************ Public Functions ************/



    /************ Protected Functions ************/

    protected function doConnect($requestmethod, $responseobject) 
    {

        $request = $this->request;

        if (empty($request) || (get_class($request) != ltrim($this->requestObject, '\\'))) {
            throw new \Agms\Exception\RequestValidationException('No request has been created, please define request parameters.');
            return false;
        } else {

            $connect = new \Agms\Utility\Connect();

            $requestBody = $request->get($this->username, $this->password, $this->account, $this->key);

            $response = $connect->connect($this->api_url, $requestBody, $requestmethod, $responseobject);
            $this->response = new $this->responseObject($response, $this->op);

            if (\Agms\Utility\Settings::$Verbose)
                print_r($this->response);

        }

        return $this->response;

    } // doConnect()


    // Sets field values and options for the API request
    protected function setParameter($field, $opts) 
    {

        if (!$this->request)
            $this->request = new $this->requestObject($this->op);

        if (is_array($opts) && (sizeof($opts) > 0)) {

            foreach ($opts AS $param => $value) {

                $this->request->setField($field, $param, $value);

            } // opts

        } elseif (!is_array($opts)) {

            // If provided opts is not an array, assume that its a value param
            $this->request->setField($field, 'value', $opts);

        } else {

            // Empty array is invalid
            throw new \Agms\Exception\InvalidParameterException('Provided options are not in valid array format.');

        }

        return true;

    } // setParameter()


    protected function resetParameters() 
    {

        unset($this->request);

        $this->request = new $this->requestObject($this->op);

        return true;

    } // resetParameters()


	/************ Destructor ************/



} // Agms Class
