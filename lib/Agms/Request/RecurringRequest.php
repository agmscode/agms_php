<?php

/**
 *
 * Builds all the fields to be used in an Recurring API request
 *
 * @package    AGMS
 * @subpackage Request
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Request;

class RecurringRequest extends Request 
{

	/************ Object Variables ************/
	protected $fields1 = array(
		'RecurringID' => array('setting' => '', 'value' => ''),
		'MerchantID' => array('setting' => '', 'value' => ''),
		'InitialAmount' => array('setting' => '', 'value' => ''),
		'RecurringAmount' => array('setting' => '', 'value' => ''),
        'StartDate' => array('setting' => '', 'value' => ''),
        'Frequency' => array('setting' => '', 'value' => ''),
        'Quantity' => array('setting' => '', 'value' => ''),
        'NumberOfOccurrences' => array('setting' => '', 'value' => ''),
        'EndDate' => array('setting' => '', 'value' => ''),
        'NumberOfRetries' => array('setting' => '', 'value' => ''),
        'PaymentType' => array('setting' => '', 'value' => ''),
        'CCNumber' => array('setting' => '', 'value' => ''),
		'CCExpDate' => array('setting' => '', 'value' => ''),
		'CVV' => array('setting' => '', 'value' => ''),
		'CheckName' => array('setting' => '', 'value' => ''),
		'CheckABA' => array('setting' => '', 'value' => ''),
		'CheckAccount' => array('setting' => '', 'value' => ''),
		'AccountHolderType' => array('setting' => '', 'value' => ''),
		'AccountType' => array('setting' => '', 'value' => ''),
		'SecCode' => array('setting' => '', 'value' => ''),
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

	protected $fields4 = array(
		'MerchantID' => array('setting' => '', 'value' => ''),
	);

	
	// Fields that must be numeric
	protected $numeric = array('InitialAmount', 'RecurringAmount', 'Quantity', 'NumberOfOccurrences', 'NumberOfRetries', 'CCNumber', 'CCExpDate', 'CheckABA', 'CheckAccount');

	// Allowed values for enumerated fields
	protected $enums = array(
							'PaymentType' => array('creditcard', 'check'),
							'SecCode' => array('PPD', 'WEB', 'TEL', 'CCD'),
							'AccountHolderType' => array('business', 'personal'),
							'AccountType' => array('checking', 'savings'),
							'Frequency' => array('days', 'months', 'weeks'),
						);

	// Required Fields
//	protected $required = array('TransactionType');

	// Fields that must be dates
	protected $date = array('StartDate', 'EndDate');

	// Fields that must be 2 digit state codes
	protected $state = array('State');

	// Fields that need to be validated against amount minimum and maximum
	protected $amount = array('InitialAmount','RecurringAmount');


	/************ Constructor ************/
	public function __construct($op) 
	{

		parent::__construct($op);

		switch ($this->op) {

			case 'RecurringAdd':
				$this->fields = $this->fields1;
				$this->required = array('Frequency', 'NumberOfRetries');
				break;

			case 'RecurringUpdate':
				$this->fields = $this->fields2;
				$this->required = array('Frequency', 'NumberOfRetries', 'not finished');
				break;

			case 'RecurringDelete':
				$this->fields = $this->fields3;
				$this->required = array('Frequency', 'NumberOfRetries', 'not finished');
				break;

			case 'RetrieveRecurringID':
				$this->fields = $this->fields4;
				$this->required = array('MerchantID');
				$this->enums = $this->numeric = $this->date = $this->state = $this->amount = array();
				break;

		} // switch op

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


} // RecurringRequest
