<h1>Boarding Usage Examples</h1>
<br /><br />
<a href="index.php">Back to Index</a>
<br /><br />
<pre>
<?php

require('init.php');

/**
 *
 * Retrieve all stored pricing structures on the agent account
 * 
 **/
/*

$boarding = new \Agms\Boarding('demoagent123', 'Nelix123!', '1000103', '0');

$params = array();

$result = $boarding->getPricing($params);

var_dump($result);

unset($boarding, $result);
*/


/**
 *
 * A minimalist example of boarding a merchant
 * 
 **/


$boarding = new \Agms\Boarding('demoagent123', 'Nelix123!', '1000103', '0');

$params = array(
			'MerchantName' => 'AGMS Boarding API Test ' . date('n/j/y G:i'),
			'LegalName' => 'AGMS Boarding API Test ' . date('n/j/y G:i'),
			'Address1' => '123 Main St.',
			'City' => 'Dallas',
			'State' => 'TX',
			'ZipCode' => '75248',
			'Country' => 'US',
			'Phone' => '214-491-4400',
			'Fax' => '214-491-4401',
			'Website' => 'www.agms.com',
			'ContactFirstName' => 'Mike',
			'ContactLastName' => 'Varian',
			'ContactEmail' => 'mike@agms.com',
			'ContactUsername' => 'agmsmike',
			'ContactPhone' => '214-491-4400',
			'ContactFax' => '214-491-4401',
			'CorporateAddress1' => '123 Main St.',
			'CorporateCity' => 'Dallas',
			'CorporateState' => 'TX',
			'CorporateZipCode' => '75248',
			'CorporateCountry' => 'US',
			'Timezone' => '0',
			'SettlementTime' => '11:58 PM',
			'PrimaryCheckName' => 'API Test',
			'PrimaryCheckABA' => '123456789',
			'PrimaryCheckAccount' => '987654321',
			'PrimaryAccountHolderType' => 'business',
			'PrimaryAccountType' => 'checking',
			'PrimarySecCode' => 'PPD',
			'SecondaryType' => 'cc',
			'SecondaryCCNumber' => '4111111111111111',
			'SecondaryCCExpDate' => '1230',
			'StoredPricingID' => '29',
			'ProcessorID' => '11',
			'ProcessorNickname' => 'TSYS',
			'Sierra_MerchantNumber' => '123456789100',
			'Sierra_Industry' => 'E',
			'Sierra_AcquirerBin' => '123456',
			'Sierra_StoreNumber' => '1234',
			'Sierra_TerminalNumber' => '0001',
			'Sierra_MerchantCategory' => '8999',
			'Sierra_LocationNumber' => '12345',
			'Sierra_VitalNumber' => '12345678',
			'Sierra_AgentBank' => '123456',
			'Sierra_AgentChain' => '123456',
			'Sierra_PaymentDescriptor' => '',
			'Sierra_CustomerServicePhone' => '2144914400',
/*
			'ProfitStars_StoreID' => '',
			'ProfitStars_StoreKey' => '',
			'ProfitStars_EntityID' => '',
			'ProfitStars_LocationID' => '',*/
		);

$result = $boarding->board($params);

var_dump($result);

unset($boarding, $result);

