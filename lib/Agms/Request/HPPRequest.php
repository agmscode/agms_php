<?php

/**
 *
 * Builds all the fields to be used in an HPP generation request
 *
 * @package    AGMS
 * @subpackage Request
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Request;

class HPPRequest extends Request 
{

	/************ Object Variables ************/
	protected $fields = array(
        'HPPFormat' => array('setting' => '', 'value' => ''),
        'Amount' => array('setting' => '', 'value' => ''),
		'OrderDescription' => array('setting' => '', 'value' => ''),
		'RetURL' => array('setting' => '', 'value' => ''),
		'ACHEnabled' => array('setting' => '', 'value' => '0'),
		'SAFE_ID' => array('setting' => '', 'value' => ''),
		'TransactionType' => array('setting' => '', 'value' => ''),
		'AutoSAFE' => array('setting' => '', 'value' => ''),
        'SupressAutoSAFE' => array('setting' => '', 'value' => ''),
        'ProcessorID' => array('setting' => '', 'value' => ''),
		'Donation' => array('setting' => '', 'value' => 'False'),
		'UsageCount' => array('setting' => '', 'value' => '9999999'),
        'StartDate' => array('setting' => '', 'value' => ''),
        'EndDate' => array('setting' => '', 'value' => ''),
        'StartTime' => array('setting' => '', 'value' => ''),
        'EndTime' => array('setting' => '', 'value' => ''),
        'Internal' => array('setting' => '', 'value' => ''),
		'FirstName' => array('setting' => '', 'value' => ''),
		'LastName' => array('setting' => '', 'value' => ''),
		'Company' => array('setting' => '', 'value' => ''),
		'Address1' => array('setting' => '', 'value' => ''),
		'Address2' => array('setting' => '', 'value' => ''),
		'City' => array('setting' => '', 'value' => ''),
		'State' => array('setting' => '', 'value' => ''),
		'Zip' => array('setting' => '', 'value' => ''),
		'Country' => array('setting' => '', 'value' => ''),
		'Phone' => array('setting' => '', 'value' => ''),
		'Fax' => array('setting' => '', 'value' => ''),
		'EMail' => array('setting' => '', 'value' => ''),
		'Website' => array('setting' => '', 'value' => ''),
		'Tax' => array('setting' => '', 'value' => ''),
		'Shipping' => array('setting' => '', 'value' => ''),
		'OrderID' => array('setting' => '', 'value' => ''),
		'PONumber' => array('setting' => '', 'value' => ''),
		'ShippingFirstName' => array('setting' => '', 'value' => ''),
		'ShippingLastName' => array('setting' => '', 'value' => ''),
		'ShippingCompany' => array('setting' => '', 'value' => ''),
		'ShippingAddress1' => array('setting' => '', 'value' => ''),
		'ShippingAddress2' => array('setting' => '', 'value' => ''),
		'ShippingCity' => array('setting' => '', 'value' => ''),
		'ShippingState' => array('setting' => '', 'value' => ''),
		'ShippingZip' => array('setting' => '', 'value' => ''),
		'ShippingCountry' => array('setting' => '', 'value' => ''),
		'ShippingEmail' => array('setting' => '', 'value' => ''),
		'ShippingPhone' => array('setting' => '', 'value' => ''),
		'ShippingFax' => array('setting' => '', 'value' => ''),
		'ShippingTrackingNumber' => array('setting' => '', 'value' => ''),
		'ShippingCarrier' => array('setting' => '', 'value' => ''),
		'Custom_Field_1' => array('setting' => '', 'value' => ''),
		'Custom_Field_2' => array('setting' => '', 'value' => ''),
		'Custom_Field_3' => array('setting' => '', 'value' => ''),
		'Custom_Field_4' => array('setting' => '', 'value' => ''),
		'Custom_Field_5' => array('setting' => '', 'value' => ''),
		'Custom_Field_6' => array('setting' => '', 'value' => ''),
		'Custom_Field_7' => array('setting' => '', 'value' => ''),
		'Custom_Field_8' => array('setting' => '', 'value' => ''),
		'Custom_Field_9' => array('setting' => '', 'value' => ''),
		'Custom_Field_10' => array('setting' => '', 'value' => ''),
	);

	
	// Fields that can be Required, Visible, or Disabled
	protected $optionable = array(
		'FirstName', 'LastName', 'Company', 'Address1', 'Address2', 
		'City', 'State', 'Zip', 'Country', 'Phone', 'Fax',
		'EMail', 'Website', 'Tax', 'Shipping', 'OrderID', 
		'PONumber', 'ShippingFirstName', 'ShippingLastName', 'ShippingCompany', 'ShippingAddress1',
		'ShippingAddress2', 'ShippingCity', 'ShippingState', 'ShippingZip', 'ShippingCountry', 
		'ShippingEmail', 'ShippingPhone', 'ShippingFax', 'ShippingTrackingNumber', 'ShippingCarrier',
		'Custom_Field_1', 'Custom_Field_2', 'Custom_Field_3', 'Custom_Field_4', 'Custom_Field_5',
		'Custom_Field_6', 'Custom_Field_7', 'Custom_Field_8', 'Custom_Field_9', 'Custom_Field_10'
	);


	// Fields that must be numeric
	protected $numeric = array('Amount', 'Tax', 'Shipping', 'ProcessorID', 'HPPFormat');

	// Enumerated Fields
	protected $enums = array(
		'TransactionType' => array('sale', 'auth', 'safe only'),
		'ShippingCarrier' => array('ups', 'fedex', 'dhl', 'usps', 'UPS', 'Fedex', 'DHL', 'USPS'),
		'HPPFormat' => array(1, 2),
	);

	// Required Fields
	protected $required = array('TransactionType');

	// Boolean Fields
	protected $boolean = array('Donation', 'AutoSAFE', 'SupressAutoSAFE');

	// Fields that must be 2 digit state codes
	protected $state = array('State', 'ShippingState');

	// Fields that must be dates
	protected $date = array('StartDate', 'EndDate');

	// Fields that must be times
	protected $time = array('StartTime', 'EndTime');

	// Fields that need to be validated against amount minimum and maximum
	protected $amount = array('Amount', 'Shipping');


	/************ Constructor ************/


	/************ Public Functions ************/

	public function validate() 
	{

		// All sales and auths require an amount unless donation
		if ((empty($this->fields['Donation']['value']) || ($this->fields['Donation']['value'] === false)) && (($this->fields['TransactionType']['value'] == 'sale') || ($this->fields['TransactionType']['value'] == 'auth')))
			$this->required[] = 'Amount';

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

		$fields = $this->getFieldArray();

		if (array_key_exists('AutoSAFE', $fields)) {
			if($fields['AutoSAFE'] === true)
				$fields['AutoSAFE'] = 1;
			else
				$fields['AutoSAFE'] = 0;
		}

		if (array_key_exists('SupressAutoSAFE', $fields)) {
			if ($fields['SupressAutoSAFE'] === true)
				$fields['SupressAutoSAFE'] = 1;
			else
				$fields['SupressAutoSAFE'] = 0;
		}

		return $fields;

	} // getFields()


	/************ Private Functions ************/


	/************ Destructor************/


} // HPPRequest
