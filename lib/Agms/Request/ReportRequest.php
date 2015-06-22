<?php

/**
 *
 * Builds all the fields to be used in an Report query generation request
 *
 * @package    AGMS
 * @subpackage Request
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Request;

class ReportRequest extends Request 
{

	/************ Object Variables ************/
	protected $transfields = array(
		'Amount' => array('setting' => '', 'value' => ''),
		'FirstName' => array('setting' => '', 'value' => ''),
		'LastName' => array('setting' => '', 'value' => ''),
		'Company' => array('setting' => '', 'value' => ''),
		'Address1' => array('setting' => '', 'value' => ''),
		'City' => array('setting' => '', 'value' => ''),
		'State' => array('setting' => '', 'value' => ''),
		'Zip' => array('setting' => '', 'value' => ''),
		'Country' => array('setting' => '', 'value' => ''),
		'Phone' => array('setting' => '', 'value' => ''),
		'EMail' => array('setting' => '', 'value' => ''),
		'Safe_ID' => array('setting' => '', 'value' => ''),
		'TransactionType' => array('setting' => '', 'value' => ''),
		'PaymentType' => array('setting' => '', 'value' => ''),
		'StartDate' => array('setting' => '', 'value' => ''),
		'EndDate' => array('setting' => '', 'value' => ''),
		'ProcessorID' => array('setting' => '', 'value' => ''),
		'TransactionID' => array('setting' => '', 'value' => ''),
		'CreditCardLast4' => array('setting' => '', 'value' => ''),
	);
	
	protected $safefields = array(
		'Active' => array('setting' => '', 'value' => ''),
		'PaymentType' => array('setting' => '', 'value' => ''),
		'SafeID' => array('setting' => '', 'value' => ''),
		'StartDate' => array('setting' => '', 'value' => ''),
		'EndDate' => array('setting' => '', 'value' => ''),
		'FirstName' => array('setting' => '', 'value' => ''),
		'LastName' => array('setting' => '', 'value' => ''),
		'Company' => array('setting' => '', 'value' => ''),
		'EMail' => array('setting' => '', 'value' => ''),
		'Expiring30' => array('setting' => '', 'value' => ''),
	);


	// Fields that must be numeric
	protected $numeric = array('Amount', 'ProcessorID', 'TransactionID', 'CreditCardLast4');

	// Fields that must be dates
	protected $date = array('StartDate', 'EndDate');

	// Fields that must be 2 digit state codes
	protected $state = array('State');


	/************ Constructor ************/
	public function __construct($op) 
	{

		parent::__construct($op);

		switch ($this->op) {

			case 'TransactionAPI':

				$this->fields = $this->transfields;

				// Override mapping with api-specific field maps
				self::$mapping['safe_id'] = 'Safe_ID';
				self::$mapping['gateway_username'] = 'GatewayUsername';

				break;

			case 'QuerySAFE':

				$this->fields = $this->safefields;
			
				// Override mapping with api-specific field maps
				self::$mapping['safe_id'] = 'SafeID';
				self::$mapping['gateway_username'] = 'GatewayUsername';
				self::$mapping['gateway_key'] = 'APIKey';

				break;

			default:
           		throw new \Agms\Exception\InvalidRequestException('Invalid op in Request.');
				break;

		} // switch op

		$this->needsAccount = true;
		$this->needsKey = true;

	} // constructor()


	/************ Public Functions ************/

	public function validate() 
	{

		$errorarray = $this->autoValidate();

		$errors = $errorarray['errors'];
		$message = $errorarray['message'];

		$this->validateErrors = $errors;
		$this->validateMessages = $message;

		if ($errors == 0) {
			return array('errors' => $errors, 'message' => $message);
		} else {
			throw new \Agms\Exception\RequestValidationException('Request validation failed with ' . implode('  ', $message) . '.');
		}
		
	} // validate()
	

	public function getFields() 
	{

		return $this->getFieldArray();

	} // getFields()


	/************ Private Functions ************/


	/************ Destructor************/


} // ReportRequest


?>