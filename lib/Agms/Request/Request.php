<?php

/**
 *
 * Abstract Request object containing common methods and variables for API-specific request objects
 *
 * @package    AGMS
 * @subpackage Request
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Request;

abstract class Request 
{

	/************ Object Variables ************/
	protected $validateErrors = -1;
	protected $validateMessages;

	protected $op;
	protected $fields;

	// Placeholders to prevent undefined errors
	protected $required;
	protected $numeric;
	protected $optionable;
	protected $enums;
	protected $date;
	protected $time;
	protected $boolean;
	protected $state;
	protected $amount;

	protected $needsAccount;
	protected $needsKey;

	// Friendly fieldname mapping
	protected static $mapping_alias;
	protected static $mapping = array(
		'gateway_username' => 'GatewayUserName',
		'gateway_password' => 'GatewayPassword',
		'gateway_account' => 'AccountNumber',
		'gateway_key' => 'TransactionAPIKey',
		'amount' => 'Amount',
		'description' => 'OrderDescription',
		'order_description' => 'OrderDescription',
		'return_url' => 'RetURL',
		'enable_ach' => 'ACHEnabled',
		'transaction_type' => 'TransactionType',
		'payment_type' => 'PaymentType',
		'enable_auto_add_to_safe' => 'AutoSAFE',
		'processing_account_id' => 'ProcessorID',
		'enable_donation' => 'Donation',
		'max_link_uses' => 'UsageCount',
		'cc_number' => 'CCNumber',
		'cc_exp_date' => 'CCExpDate',
		'cc_cvv' => 'CVV',
		'cc_track_1' => 'Track1',
		'cc_track_2' => 'Track2',
		'cc_track_3' => 'Track3',
		'cc_encrypted_data' => 'MagData',
		'cc_encrypted_hardware' => 'MagHardware',
		'ach_name' => 'CheckName',
		'ach_routing_number' => 'CheckABA',
		'ach_account_number' => 'CheckAccount',
		'ach_business_or_personal' => 'AccountHolderType',
		'ach_checking_or_savings' => 'AccountType',
		'ach_sec_code' => 'SecCode',
		'safe_action' => 'SAFE_Action',
		'safe_id' => 'SAFE_ID',
		'first_name' => 'FirstName',
		'last_name' => 'LastName',
		'company_name' => 'Company',
		'company' => 'Company',
		'address' => 'Address1',
		'address_1' => 'Address1',
		'address_2' => 'Address2',
		'city' => 'City',
		'state' => 'State',
		'zip' => 'Zip',
		'country' => 'Country',
		'phone' => 'Phone',
		'fax' => 'Fax',
		'email' => 'EMail',
		'website' => 'Website',
		'tax_amount' => 'Tax',
		'shipping_amount' => 'Shipping',
		'tip_amount' => 'TipAmount',
		'order_id' => 'OrderID',
		'po_number' => 'PONumber',
		'clerk_id' => 'ClerkID',
		'ip_address' => 'IPAddress',
		'receipt_type' => 'ReceiptType',
		'shipping_first_name' => 'ShippingFirstName',
		'shipping_last_name' => 'ShippingLastName',
		'shipping_company_name' => 'ShippingCompany',
		'shipping_company' => 'ShippingCompany',
		'shipping_address' => 'ShippingAddress1',
		'shipping_address_1' => 'ShippingAddress1',
		'shipping_address_2' => 'ShippingAddress2',
		'shipping_city' => 'ShippingCity',
		'shipping_state' => 'ShippingState',
		'shipping_zip' => 'ShippingZip',
		'shipping_country' => 'ShippingCountry',
		'shipping_email' => 'ShippingEmail',
		'shipping_phone' => 'ShippingPhone',
		'shipping_fax' => 'ShippingFax',
		'shipping_tracking_number' => 'ShippingTrackingNumber',
		'shipping_carrier' => 'ShippingCarrier',
		'custom_field_1' => 'Custom_Field_1',
		'custom_field_2' => 'Custom_Field_2',
		'custom_field_3' => 'Custom_Field_3',
		'custom_field_4' => 'Custom_Field_4',
		'custom_field_5' => 'Custom_Field_5',
		'custom_field_6' => 'Custom_Field_6',
		'custom_field_7' => 'Custom_Field_7',
		'custom_field_8' => 'Custom_Field_8',
		'custom_field_9' => 'Custom_Field_9',
		'custom_field_10' => 'Custom_Field_10',
		'start_date' => 'StartDate',
		'end_date' => 'EndDate',
		'expiring_in_30_days' => 'Expiring30',
		'recurring_id' => 'RecurringID',
		'merchant_id' => 'MerchantID',
		'initial_amount' => 'InitialAmount',
		'recurring_amount' => 'RecurringAmount',
		'frequency' => 'Frequency',
		'quantity' => 'Quantity',
		'number_of_times_to_bill' => 'NumberOfOccurrences',
		'number_of_retries' => 'NumberOfRetries',
		'hpp_format' => 'HPPFormat',
		'cc_last_4' => 'CreditCardLast4',
		'transaction_id' => 'TransactionID',
		'start_time' => 'StartTime',
		'end_time' => 'EndTime',
		'suppress_safe_option' => 'SupressAutoSAFE',
	);


	/************ Constructor ************/
	public function __construct($op) 
	{

		$this->op = $op;

		for ($i = 1; $i <= 10; $i++) {

		    $constant_name = 'Custom_Name_' . $i;

			// Verify that custom fieldnames don't impose on any reserved keywords
		    if (\Agms\Request\Request::checkForName(\Agms\Utility\Settings::$$constant_name))
		        throw new \Agms\Exception\ConfigurationException('Invalid custom field name "' . \Agms\Utility\Settings::$$constant_name . '" for ' . $constant_name . ', this is a reserved name and cannot be used.');
		    else
				self::$mapping_alias[\Agms\Utility\Settings::$$constant_name] = 'Custom_Field_' . $i;

		}

	} // constructor()


	/************ Static Functions ************/
	// Used by Agms.php initialization to verify that custom fields don't collide with reserved names
	public static function checkForName($name) 
	{

		if (array_key_exists($name, self::$mapping))
			return true;
		else
			return false;

	} // checkForName()


	/************ Public Functions ************/

	// Returns prepared array for immediate use in connection
	public function get($username, $password, $account, $key) 
	{

            $requestBody = $this->getFields();

            $requestBody['GatewayUserName'] = $username;
            $requestBody['GatewayPassword'] = $password;

            // Adjust for a field name variation in the Reporting API
            if (($this->op == 'TransactionAPI') || ($this->op == 'QuerySAFE')) {
        	    unset($requestBody['GatewayUserName']);
        	    $requestBody['GatewayUsername'] = $username;
        	}

			// Add Account # and API Key field to request when necessary for specific API
            if ($this->needsAccount)
				$requestBody['AccountNumber'] = $account;

            if ($this->needsKey) {

				$requestBody['TransactionAPIKey'] = $key;

	            // Adjust for a field name variation in the Reporting API
	            if (($this->op == 'QuerySAFE')) {
	        	    unset($requestBody['TransactionAPIKey']);
	        	    $requestBody['APIKey'] = $key;
	        	}

            }

            return $requestBody;

	} // get()


	// Used to configure settings for a field, returns false if fails, true if successful
	public function setField($name, $parameter, $value) 
	{

		$fieldname = $this->mapToField($name);

		// Fix for odd capitalization of Email
		if ($fieldname == 'Email')
			$fieldname = 'EMail';
		if ($fieldname == 'ShippingEmail')
			$fieldname = 'ShippingEMail';

		// Check that field exists
		if (!$this->fields[$fieldname]) {
			throw new \Agms\Exception\InvalidParameterException('Invalid fieldname ' . $name . '.');
		}

		// Ensure that setting parameters are forced to all lowercase and are case insensitive
		if ($parameter == 'setting')
			$value = strtolower($value);

		// Check that it is a valid setting
		if (($parameter == 'setting') && !empty($value) && ($value != 'required') && ($value != 'disabled') && ($value != 'visible') && ($value != 'excluded') && ($value != 'hidden')) {
			throw new \Agms\Exception\InvalidParameterException('Invalid parameter ' . $parameter . ' for ' . $name . '.');
		}

		switch($parameter) {

			case 'setting':
				$this->fields[$fieldname]['setting'] = $value;
				return true;
				break;

			case 'value':
				$this->fields[$fieldname]['value'] = $value;
				return true;
				break;

			default:
				// Invalid parameter
				throw new \Agms\Exception\InvalidParameterException('Invalid parameter ' . $parameter . ' for ' . $name . '.');
				break;

		}

	} // setField()


	// Returns current array of settings for a given field
	public function getField($name) 
	{

		$fieldname = $this->mapToField($name);

		return $this->fields[$fieldname];

	} // getField()


	public function getValidationErrors() 
	{

		return $this->validateErrors;

	} // getValidationErrors()


	public function getValidationMessages() 
	{

		return $this->validateMessages;

	} // getValidationErrors()


	public function setMappingAlias($name, $field) 
	{

	    if (\Agms\Request\Request::checkForName($name))
	        throw new \Agms\Exception\ConfigurationException('Invalid custom field name "' . constant($name) . '", this is a reserved name and cannot be used.');
	    else
			self::$mapping_alias[$name] = $field;

	} // setMappingAlias()


	/************ Protected Functions ************/

	// Validates that all field configuration is valid
	protected function autoValidate() 
	{

		$errors = 0;
		$message = array();

		// Validate required fields
		if ($this->required) {
			foreach ($this->required AS $fieldname) {
				if (!$this->fields[$fieldname]['value']) {
					$errors++;
					$message[] = 'Missing required field ' . $fieldname . '.';
				}
			}
		} // required

		// Validate enumerated types
		if ($this->enums) {
			foreach ($this->enums AS $fieldname => $validvalues) {
				if ($this->fields[$fieldname]['value'] && !in_array($this->fields[$fieldname]['value'], $validvalues)) {
					$errors++;
					$message[] = 'Invalid ' . $fieldname . ', value ' . $this->fields[$fieldname]['value'] . ', must be one of ' . implode(', ', $validvalues) . '.';
				}
			}
		} // transtypes


		// Validate numeric fields
		if ($this->numeric) {
			foreach ($this->numeric AS $field) {
				if (!empty($this->fields[$field]['value']) && !is_numeric($this->fields[$field]['value'])) {
					$errors++;
					$message[] = 'Field ' . $field . ' has value ' . $this->fields[$field]['value'] . ', must be numeric.';
				}
			}
		} // numeric fields

		// Validate optionable fields
		if ($this->optionable) {
			foreach ($this->optionable AS $field) {
				if (!empty($this->fields[$field]['setting']) && ($this->fields[$field]['setting'] != 'required') && ($this->fields[$field]['setting'] != 'disabled') && ($this->fields[$field]['setting'] != 'visible') && ($this->fields[$field]['setting'] != 'excluded') && ($this->fields[$field]['setting'] != 'hidden')) {
					$errors++;
					$message[] = 'Field ' . $field . ' has setting ' . $this->fields[$field]['value'] . ', must be required, disabled, visible, hidden, or empty.';
				}
			}
		} // optionable fields

		// Validate date fields
		if ($this->date) {
			foreach ($this->date AS $field) {
				if (!empty($this->fields[$field]['value']) && !preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $this->fields[$field]['value'])) {
					$errors++;
					$message[] = 'Field ' . $field . ' has setting ' . $this->fields[$field]['value'] . ', must be in date format YYYY-MM-DD.';
				}
			}
		} // date fields

		// Validate time fields
		if ($this->time) {
			foreach ($this->time AS $field) {
				if (!empty($this->fields[$field]['value']) && !preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?/', $this->fields[$field]['value'])) {
					$errors++;
					$message[] = 'Field ' . $field . ' has setting ' . $this->fields[$field]['value'] . ', must be in 24h time format HH:MM:SS or HH:MM.';
				}
			}
		} // time fields

		// Validate boolean fields
		if ($this->boolean) {
			foreach ($this->boolean AS $field) {
				if (!empty($this->fields[$field]['value']) && !($this->fields[$field]['value'] !== true) && ($this->fields[$field]['value'] !== false) && !($this->fields[$field]['value'] != 'TRUE') && ($this->fields[$field]['value'] != 'FALSE')) {
					$errors++;
					$message[] = 'Field ' . $field . ' has setting ' . $this->fields[$field]['value'] . ', must be boolean TRUE or FALSE.';
				}
			}
		} // boolean fields

		// Validate state code fields
		if ($this->state) {
			foreach ($this->state AS $field) {
				if (!empty($this->fields[$field]['value']) && !in_array($this->fields[$field]['value'], array('AL','AK','AS','AZ','AR','CA','CO','CT','DE','DC','FM','FL','GA','GU','HI','ID','IL','IN','IA','KS','KY','LA','ME','MH','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','MP','OH','OK','OR','PW','PA','PR','RI','SC','SD','TN','TX','UT','VT','VI','VA','WA','WV','WI','WY','AE','AA','AP'))) {
					$errors++;
					$message[] = 'Field ' . $field . ' has setting ' . $this->fields[$field]['value'] . ', must be valid 2 digit US State code.';
				}
			}
		} // state fields

		// Validate amount fields
		if ($this->amount) {
			foreach ($this->amount AS $field) {
				if (!empty($this->fields[$field]['value']) && ($this->fields[$field]['value'] > \Agms\Utility\Settings::$Maximum_Amount)) {
					$errors++;
					$message[] = 'Field ' . $field . ' amount ' . $this->fields[$field]['value'] . ', is above maximum allowable value of ' . MAXIMUM_AMOUNT . '.';
				}
				if (!empty($this->fields[$field]['value']) && ($this->fields[$field]['value'] < \Agms\Utility\Settings::$Minimum_Amount)) {
					$errors++;
					$message[] = 'Field ' . $field . ' amount ' . $this->fields[$field]['value'] . ', is below minimum allowable value of ' . MINIMUM_AMOUNT . '.';
				}
			}
		} // amount fields

		return array('errors' => $errors, 'message' => $message);

	} // autoValidate()


	protected function getFieldArray() 
	{

		$request = array();

		// Call validation, which ensures we've validated and done so against current data
		$this->validate();

		if ($this->validateErrors > 0) {
			// Validation errors exist
			throw new \Agms\Exception\RequestValidationException('Request validation failed with ' . implode('  ', $this->validateMessages) . '.');
		}

		foreach ($this->fields AS $field => $settings) {

			switch ($settings['setting']) {

				case 'required':
					$request[$field] = '';

					$request[$field . '_Visible'] = true;
					$request[$field . '_Required'] = true;
					if($field == 'EMail')
						$request['Email_Disabled'] = false;
					else
						$request[$field . '_Disabled'] = false;
					break;

				case 'disabled':
					$request[$field . '_Visible'] = true;
					$request[$field . '_Required'] = false;
					if($field == 'EMail')
						$request['Email_Disabled'] = true;
					else
						$request[$field . '_Disabled'] = true;
					break;

				case 'visible':
					$request[$field . '_Visible'] = true;
					$request[$field . '_Required'] = false;
					if($field == 'EMail')
						$request['Email_Disabled'] = false;
					else
						$request[$field . '_Disabled'] = false;
					break;

				case 'hidden':
				case 'excluded':
				default:
					// Do nothing, leave it out
					if($this->optionable) {
						if(in_array($field, $this->optionable)) {
							$request[$field . '_Visible'] = false;
							$request[$field . '_Required'] = false;
							if($field == 'EMail')
								$request['Email_Disabled'] = true;
							else
								$request[$field . '_Disabled'] = true;
						}
					} // optionable field
					break;

			} // settings

			if ($settings['value']) {
				if (strtoupper($settings['value']) == 'TRUE')
					$request[$field] = true;
				elseif (strtoupper($settings['value']) == 'FALSE')
					$request[$field] = false;
				else
					$request[$field] = \Agms\Utility\Connect::sanitize($settings['value']);
			}

		} // fields

		return $request;

	} // getFieldArray()


	protected function mapToField($name) 
	{

		if (array_key_exists($name, self::$mapping))
			return self::$mapping[$name];
		elseif (array_key_exists($name, self::$mapping_alias))
			return self::$mapping_alias[$name];
		elseif (array_key_exists($name, $this->fields))
			return $name;
		else
			throw new \Agms\Exception\InvalidParameterException('Invalid fieldname ' . $name . '.');

	} // mapToField()


	protected function mapToName($field) 
	{

		if ($key = array_search($field, self::$mapping))
			return $key;
		elseif ($key = array_search($field, self::$mapping_alias))
			return $key;
		elseif (array_key_exists($this->fields[$field]))
			return $field;
		else
			throw new \Agms\Exception\InvalidParameterException('Invalid field ' . $field . '.');

	} // mapToName()


	/************ Private Functions ************/


	/************ Destructor************/



} // Request
