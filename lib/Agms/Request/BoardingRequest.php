<?php

/**
 *
 * Builds all the fields to be used in a Boarding request
 *
 * @package    AGMS
 * @subpackage Request
 * @copyright  2016 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Request;

class BoardingRequest extends Request 
{

	/************ Object Variables ************/
	protected $fields = array(
		'MerchantName' => array('setting' => '', 'value' => ''),
		'LegalName' => array('setting' => '', 'value' => ''),
		'Address1' => array('setting' => '', 'value' => ''),
		'Address2' => array('setting' => '', 'value' => ''),
		'City' => array('setting' => '', 'value' => ''),
		'State' => array('setting' => '', 'value' => ''),
		'ZipCode' => array('setting' => '', 'value' => ''),
		'Country' => array('setting' => '', 'value' => ''),
		'Phone' => array('setting' => '', 'value' => ''),
		'Fax' => array('setting' => '', 'value' => ''),
		'Website' => array('setting' => '', 'value' => ''),
		'ContactFirstName' => array('setting' => '', 'value' => ''),
		'ContactLastName' => array('setting' => '', 'value' => ''),
		'ContactEmail' => array('setting' => '', 'value' => ''),
		'ContactUsername' => array('setting' => '', 'value' => ''),
		'ContactPhone' => array('setting' => '', 'value' => ''),
		'ContactFax' => array('setting' => '', 'value' => ''),
		'CorporateAddress1' => array('setting' => '', 'value' => ''),
		'CorporateAddress2' => array('setting' => '', 'value' => ''),
		'CorporateCity' => array('setting' => '', 'value' => ''),
		'CorporateState' => array('setting' => '', 'value' => ''),
		'CorporateZipCode' => array('setting' => '', 'value' => ''),
		'CorporateCountry' => array('setting' => '', 'value' => ''),
		'Timezone' => array('setting' => '', 'value' => ''),
		'SettlementTime' => array('setting' => '', 'value' => ''),
		'PrimaryCheckName' => array('setting' => '', 'value' => ''),
		'PrimaryCheckABA' => array('setting' => '', 'value' => ''),
		'PrimaryCheckAccount' => array('setting' => '', 'value' => ''),
		'PrimaryAccountHolderType' => array('setting' => '', 'value' => ''),
		'PrimaryAccountType' => array('setting' => '', 'value' => ''),
		'PrimarySecCode' => array('setting' => '', 'value' => ''),
		'SecondaryType' => array('setting' => '', 'value' => ''),
		'SecondaryCheckName' => array('setting' => '', 'value' => ''),
		'SecondaryCheckABA' => array('setting' => '', 'value' => ''),
		'SecondaryCheckAccount' => array('setting' => '', 'value' => ''),
		'SecondaryAccountHolderType' => array('setting' => '', 'value' => ''),
		'SecondaryAccountType' => array('setting' => '', 'value' => ''),
		'SecondarySecCode' => array('setting' => '', 'value' => ''),
		'SecondaryCCNumber' => array('setting' => '', 'value' => ''),
		'SecondaryCCExpDate' => array('setting' => '', 'value' => ''),
		'StoredPricingID' => array('setting' => '', 'value' => ''),
		'ProcessorID' => array('setting' => '', 'value' => ''),
		'ProcessorNickname' => array('setting' => '', 'value' => ''),
		'GETI_PPD_TID' => array('setting' => '', 'value' => ''),
		'GETI_PPD_IdentityVerification' => array('setting' => '', 'value' => ''),
		'GETI_PPD_IdentityField' => array('setting' => '', 'value' => ''),
		'GETI_PPD_DLRequired' => array('setting' => '', 'value' => ''),
		'GETI_PPD_CheckVerification' => array('setting' => '', 'value' => ''),
		'GETI_PPD_Guaranteed' => array('setting' => '', 'value' => ''),
		'GETI_CCD_TID' => array('setting' => '', 'value' => ''),
		'GETI_CCD_IdentityVerification' => array('setting' => '', 'value' => ''),
		'GETI_CCD_IdentityField' => array('setting' => '', 'value' => ''),
		'GETI_CCD_DLRequired' => array('setting' => '', 'value' => ''),
		'GETI_CCD_CheckVerification' => array('setting' => '', 'value' => ''),
		'GETI_CCD_Guaranteed' => array('setting' => '', 'value' => ''),		
		'GETI_POP_TID' => array('setting' => '', 'value' => ''),
		'GETI_POP_IdentityVerification' => array('setting' => '', 'value' => ''),
		'GETI_POP_IdentityField' => array('setting' => '', 'value' => ''),
		'GETI_POP_DLRequired' => array('setting' => '', 'value' => ''),
		'GETI_POP_CheckVerification' => array('setting' => '', 'value' => ''),
		'GETI_POP_Guaranteed' => array('setting' => '', 'value' => ''),
		'GETI_WEB_TID' => array('setting' => '', 'value' => ''),
		'GETI_WEB_IdentityVerification' => array('setting' => '', 'value' => ''),
		'GETI_WEB_IdentityField' => array('setting' => '', 'value' => ''),
		'GETI_WEB_DLRequired' => array('setting' => '', 'value' => ''),
		'GETI_WEB_CheckVerification' => array('setting' => '', 'value' => ''),
		'GETI_WEB_Guaranteed' => array('setting' => '', 'value' => ''),
		'GETI_TEL_TID' => array('setting' => '', 'value' => ''),
		'GETI_TEL_IdentityVerification' => array('setting' => '', 'value' => ''),
		'GETI_TEL_IdentityField' => array('setting' => '', 'value' => ''),
		'GETI_TEL_DLRequired' => array('setting' => '', 'value' => ''),
		'GETI_TEL_CheckVerification' => array('setting' => '', 'value' => ''),
		'GETI_TEL_Guaranteed' => array('setting' => '', 'value' => ''),
		'Nashville_MID' => array('setting' => '', 'value' => ''),
		'Nashville_TID' => array('setting' => '', 'value' => ''),
		'Nashville_DID' => array('setting' => '', 'value' => ''),
		'Nashville_Industry' => array('setting' => '', 'value' => ''),
		'Omaha_MID' => array('setting' => '', 'value' => ''),
		'Omaha_Industry' => array('setting' => '', 'value' => ''),
		'Sierra_MerchantNumber' => array('setting' => '', 'value' => ''),
		'Sierra_Industry' => array('setting' => '', 'value' => ''),
		'Sierra_AcquirerBin' => array('setting' => '', 'value' => ''),
		'Sierra_StoreNumber' => array('setting' => '', 'value' => ''),
		'Sierra_TerminalNumber' => array('setting' => '', 'value' => ''),
		'Sierra_MerchantCategory' => array('setting' => '', 'value' => ''),
		'Sierra_LocationNumber' => array('setting' => '', 'value' => ''),
		'Sierra_VitalNumber' => array('setting' => '', 'value' => ''),
		'Sierra_AgentBank' => array('setting' => '', 'value' => ''),
		'Sierra_AgentChain' => array('setting' => '', 'value' => ''),
		'Sierra_PaymentDescriptor' => array('setting' => '', 'value' => ''),
		'Sierra_CustomerServicePhone' => array('setting' => '', 'value' => ''),
		'Clearent_APIKey' => array('setting' => '', 'value' => ''),
		'ProPay_AccountNum' => array('setting' => '', 'value' => ''),
		'ProfitStars_StoreID' => array('setting' => '', 'value' => ''),
		'ProfitStars_StoreKey' => array('setting' => '', 'value' => ''),
		'ProfitStars_EntityID' => array('setting' => '', 'value' => ''),
		'ProfitStars_LocationID' => array('setting' => '', 'value' => ''),
	);


	// Fields that must be numeric
	protected $numeric = array('Timezone', 'ProcessorID', 'PrimaryCheckABA', 'SecondaryCheckABA', 'SecondaryCCNumber', 'StoredPricingID', 'GETI_PPD_TID', 'GETI_CCD_TID', 'GETI_POP_TID', 'GETI_WEB_TID', 'GETI_TEL_TID', 'Nashville_MID', 'Nashville_TID', 'Nashville_DID', 'Omaha_MID', 'Sierra_MerchantNumber', 'Sierra_AcquirerBin', 'Sierra_StoreNumber', 'Sierra_TerminalNumber', 'Sierra_MerchantCategory', 'Sierra_LocationNumber', 'Sierra_VitalNumber', 'Sierra_AgentBank', 'Sierra_AgentChain', 'ProPay_AccountNum', 'ProfitStars_StoreID');

	// Allowed values for enumerated fields
	protected $enums = array(
							'PrimarySecCode' => array('POP', 'PPD', 'WEB', 'TEL', 'CCD'),
							'SecondarySecCode' => array('POP', 'PPD', 'WEB', 'TEL', 'CCD'),
							'PrimaryAccountHolderType' => array('business', 'personal'),
							'SecondaryAccountHolderType' => array('business', 'personal'),
							'PrimaryAccountType' => array('checking', 'savings'),
							'SecondaryAccountType' => array('checking', 'savings'),
							'SecondaryType' => array('cc', 'ach'),
							'ProcessorID' => array('5', '9', '10', '11', '15', '16'),
							'GETI_CCD_IdentityField' => array('ssn', 'dob'),
							'GETI_PPD_IdentityField' => array('ssn', 'dob'),
							'GETI_POP_IdentityField' => array('ssn', 'dob'),
							'GETI_WEB_IdentityField' => array('ssn', 'dob'),
							'GETI_TEL_IdentityField' => array('ssn', 'dob'),
							'Nashville_Industry' => array('R', 'E'),
							'Omaha_Industry' => array('R', 'E'),
						);

	// Fields that must be 2 digit state codes
	protected $state = array('State', 'CorporateState');

	// Boolean Fields
	protected $boolean = array(
							'GETI_PPD_IdentityVerification', 'GETI_CCD_IdentityVerification', 'GETI_POP_IdentityVerification', 'GETI_WEB_IdentityVerification', 'GETI_TEL_IdentityVerification',
							'GETI_PPD_DLRequired', 'GETI_CCD_DLRequired', 'GETI_POP_DLRequired', 'GETI_WEB_DLRequired', 'GETI_TEL_DLRequired',
							'GETI_PPD_CheckVerification', 'GETI_CCD_CheckVerification', 'GETI_POP_CheckVerification', 'GETI_WEB_CheckVerification', 'GETI_TEL_CheckVerification',
							'GETI_PPD_Guaranteed', 'GETI_CCD_Guaranteed', 'GETI_POP_Guaranteed', 'GETI_WEB_Guaranteed', 'GETI_TEL_Guaranteed',
						);

	// Fields that need to be validated against amount minimum and maximum
	protected $amount = array();

	// Fields that must be times
	protected $time = array('SettlementTime');

	// Required Fields
	protected $required = array();

	// Fields that are allowed to be sent with a 0 value
	protected $zeroes = array('Timezone');


	/************ Constructor ************/


	/************ Public Functions ************/

	public function validate() 
	{

		$errorarray = $this->autoValidate();

		$errors = $errorarray['errors'];
		$message = $errorarray['message'];

/*
		// ABA length
		if (!empty($this->fields['CheckABA']['value']) && (strlen($this->fields['CheckABA']['value']) != 9)) {
			$errors++;
			$message[] = 'CheckABA (routing number) must be 9 digits long.'; 
		}
*/		

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


} // BoardingRequest
