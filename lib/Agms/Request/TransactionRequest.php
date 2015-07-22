<?php

/**
 *
 * Builds all the fields to be used in a Process Transaction request
 *
 * @package    AGMS
 * @subpackage Request
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Request;

class TransactionRequest extends Request 
{

	/************ Object Variables ************/
	protected $fields = array(
		'TransactionType' => array('setting' => '', 'value' => ''),
		'PaymentType' => array('setting' => '', 'value' => 'creditcard'),
		'Amount' => array('setting' => '', 'value' => ''), // Required for sale or auth
		'TipAmount' => array('setting' => '', 'value' => ''), // Required for Adjustment
		'Tax' => array('setting' => '', 'value' => ''),
		'Shipping' => array('setting' => '', 'value' => ''),
		'OrderDescription' => array('setting' => '', 'value' => ''),
		'OrderID' => array('setting' => '', 'value' => ''),
		'ClerkID' => array('setting' => '', 'value' => ''),
		'PONumber' => array('setting' => '', 'value' => ''),
		'CCNumber' => array('setting' => '', 'value' => ''), // Required for sale and auth if payment type = creditcard without safe id
		'CCExpDate' => array('setting' => '', 'value' => ''), // Required for sale and auth if payment type = creditcard without safe id
		'CVV' => array('setting' => '', 'value' => ''),
		'CheckName' => array('setting' => '', 'value' => ''), // Required for sale and auth if payment type = check without safe id
		'CheckABA' => array('setting' => '', 'value' => ''), // Required for sale and auth if payment type = check without safe id
		'CheckAccount' => array('setting' => '', 'value' => ''), // Required for sale and auth if payment type = check without safe id
		'AccountHolderType' => array('setting' => '', 'value' => ''), // Required for sale and auth if payment type = check without safe id
		'AccountType' => array('setting' => '', 'value' => ''), // Required for sale and auth if payment type = check without safe id
		'SecCode' => array('setting' => '', 'value' => ''), // Required for sale and auth if payment type = check without safe id
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
		'ProcessorID' => array('setting' => '', 'value' => ''),
		'TransactionID' => array('setting' => '', 'value' => ''),
		'Tracking_Number' => array('setting' => '', 'value' => ''),
		'Shipping_Carrier' => array('setting' => '', 'value' => ''),
		'IPAddress' => array('setting' => '', 'value' => ''),
		'Track1' => array('setting' => '', 'value' => ''),
		'Track2' => array('setting' => '', 'value' => ''),
		'Track3' => array('setting' => '', 'value' => ''),
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
		'SAFE_Action' => array('setting' => '', 'value' => ''),
		'SAFE_ID' => array('setting' => '', 'value' => ''),
		'ReceiptType' => array('setting' => '', 'value' => ''),
		'MagData' => array('setting' => '', 'value' => ''),
		'MagHardware' => array('setting' => '', 'value' => ''),
	);


	// Fields that must be numeric
	protected $numeric = array('Amount', 'Tax', 'Shipping', 'ProcessorID', 'TransactionID', 'CheckABA', 'CheckAccount', 'CCNumber', 'CCExpDate');

	// Allowed values for enumerated fields
	protected $enums = array(
							'TransactionType' => array('sale', 'auth', 'safe only', 'capture', 'void', 'refund', 'update', 'adjustment'),
							'SAFE_Action' => array('add_safe', 'update_safe', 'delete_safe'),
							'PaymentType' => array('creditcard', 'check'),
							'SecCode' => array('PPD', 'WEB', 'TEL', 'CCD'),
							'AccountHolderType' => array('business', 'personal'),
							'AccountType' => array('checking', 'savings'),
							'MagHardware' => array('MAGTEK', 'IDTECH'),
							'Shipping_Carrier' => array('ups', 'fedex', 'dhl', 'usps', 'UPS', 'Fedex', 'DHL', 'USPS'),
						);

	// Fields that must be 2 digit state codes
	protected $state = array('State', 'ShippingState');

	// Fields that need to be validated against amount minimum and maximum
	protected $amount = array('Amount', 'TipAmount', 'Tax', 'Shipping');


	/************ Constructor ************/
	public function __construct($op) 
	{

		parent::__construct($op);

		// Override mapping with api-specific field maps
		self::$mapping['shipping_tracking_number'] = 'Tracking_Number';
		self::$mapping['shipping_carrier'] = 'Shipping_Carrier';

	} // constructor()


	/************ Public Functions ************/

	public function validate() 
	{

		$this->required = '';

		// Unless this is a safe action only request, require a transaction type
		if (empty($this->fields['SAFE_Action']['value']))
			$this->required[] = 'TransactionType';

		// If no transaction type, require a Safe Action
		if (empty($this->fields['TransactionType']['value']))
			$this->required[] = 'SAFE_Action';

		// All sales and auths require an amount
		if (($this->fields['TransactionType']['value'] == 'sale') || ($this->fields['TransactionType']['value'] == 'auth'))
			$this->required[] = 'Amount';

		// captures, refunds, voids, updates, adjustments need a Transaction ID
		if (($this->fields['TransactionType']['value'] == 'capture') || ($this->fields['TransactionType']['value'] == 'refund') || ($this->fields['TransactionType']['value'] == 'void') || ($this->fields['TransactionType']['value'] == 'adjustment'))
			$this->required[] = 'TransactionID';

		// Require TipAmount for Tip Adjustment transactions
		if ($this->fields['TransactionType']['value'] == 'adjustment')
			$this->required[] = 'TipAmount';

		// All safe updates and deletes require a safe id
		if (($this->fields['SAFE_Action']['value'] == 'update') || ($this->fields['SAFE_Action']['value'] == 'delete'))
			$this->required[] = 'SAFE_ID';


		if ($this->fields['PaymentType']['value'] == 'check') {
			// Check transaction

			if (empty($this->fields['SAFE_ID']['value'])) {

				// If no Safe ID we need all the check info
				$this->required[] = 'CheckName';
				$this->required[] = 'CheckABA';
				$this->required[] = 'CheckAccount';

				if (($this->fields['TransactionType']['value'] == 'sale') || ($this->fields['TransactionType']['value'] == 'auth'))
					$this->required[] = 'SecCode';

			}

		} else {
			// Credit card transaction

			// If no SAFE ID and its a sale or auth
			if (empty($this->fields['SAFE_ID']['value']) && (($this->fields['TransactionType']['value'] == 'sale') || ($this->fields['TransactionType']['value'] == 'auth'))) {

				// If no Safe ID we need the card info
				
				// If no MagData then we need keyed info
				if (empty($this->fields['MagData']['value'])) {
					$this->required[] = 'CCNumber';
					$this->required[] = 'CCExpDate';
				} else {
					$this->required[] = 'MagHardware';
				}

			}

		}

		$errorarray = $this->autoValidate();

		$errors = $errorarray['errors'];
		$message = $errorarray['message'];

		// ExpDate MMYY
		if (!empty($this->fields['CCExpDate']['value']) && ((strlen($this->fields['CCExpDate']['value']) != 4) || !preg_match("/^(0[1-9]|1[0-2])([0-9][0-9])$/", $this->fields['CCExpDate']['value']))) {
			$errors++;
			$message[] = 'CCExpDate (credit card expiration date) must be MMYY.'; 
		}

		// CCNumber length
		if (!empty($this->fields['CCNumber']['value']) && (strlen($this->fields['CCNumber']['value']) != 16) && (strlen($this->fields['CCNumber']['value']) != 15)) {
			$errors++;
			$message[] = 'CCNumber (credit card number) must be 15-16 digits long.'; 
		}		

		// ABA length
		if (!empty($this->fields['CheckABA']['value']) && (strlen($this->fields['CheckABA']['value']) != 9)) {
			$errors++;
			$message[] = 'CheckABA (routing number) must be 9 digits long.'; 
		}
		

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


} // TransactionRequest
