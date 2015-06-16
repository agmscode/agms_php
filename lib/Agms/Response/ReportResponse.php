<?php

/**
 *
 * Captures response data from Reporting/Query API request
 *
 * @package    AGMS
 * @subpackage Response
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Response;

use \Agms\Agms;
use \Agms\Exception\InvalidRequestException;

class ReportResponse extends Response 
{

	/************ Object Variables ************/
	protected $response;


	/************ Constructor ************/
	public function __construct($response, $op) 
	{

		$this->op = $op;

		switch ($this->op) {

			case 'TransactionAPI':

				$this->mapping = array(
					'id' => 'id',
					'transactionid' => 'transaction_id',
					'transactiontype' => 'transaction_type',
					'paymenttype' => 'payment_type',
					'amount' => 'amount',
					'orderdescription' => 'order_description',
					'orderid' => 'order_id',
					'ponumber' => 'po_number',
					'tax' => 'tax_amount',
					'shipping' => 'shipping_amount',
					'tipamount' => 'tip_amount',
					'ccnumber' => 'cc_number',
					'ccexpdate' => 'cc_exp_date',
					'checkname' => 'ach_name',
					'checkaba' => 'ach_routing_number',
					'checkaccount' => 'ach_account_number',
					'accountholdertype' => 'ach_business_or_personal',
					'accounttype' => 'ach_checking_or_savings',
					'seccode' => 'ach_sec_code',
					'safeaction' => 'safe_action',
					'responsesafeid' => 'safe_id',
					'safeid'=> 'safe_id',
					'clerkid' => 'clerk_id',
					'firstname' => 'first_name',
					'lastname' => 'last_name',
					'company' => 'company_name',
					'address1' => 'address',
					'address2' => 'address_2',
					'city' => 'city',
					'state' => 'state',
					'zip' => 'zip',
					'country' => 'country',
					'phone' => 'phone',
					'fax' => 'fax',
					'email' => 'email',
					'website' => 'website',
					'shippingfirstname' => 'shipping_first_name',
					'shippinglastname' => 'shipping_last_name',
					'shippingcompany' => 'shipping_company_name',
					'shippingaddress1' => 'shipping_address',
					'shippingaddress2' => 'shipping_address_2',
					'shippingcity' => 'shipping_city',
					'shippingstate' => 'shipping_state',
					'shippingzip' => 'shipping_zip',
					'shippingcountry' => 'shipping_country',
					'shippingemail' => 'shipping_email',
					'shippingphone' => 'shipping_phone',
					'shippingfax' => 'shipping_fax',
					'shippingcarrier' => 'shipping_carrier',
					'trackingnumber' => 'shipping_tracking',
					'ipaddress' => 'ip_address',
					'customfield1' => 'custom_field_1',
					'customfield2' => 'custom_field_2',
					'customfield3' => 'custom_field_3',
					'customfield4' => 'custom_field_4',
					'customfield5' => 'custom_field_5',
					'customfield6' => 'custom_field_6',
					'customfield7' => 'custom_field_7',
					'customfield8' => 'custom_field_8',
					'customfield9' => 'custom_field_9',
					'customfield10' => 'custom_field_10',
					'customfield11' => 'custom_field_11',
					'customfield12' => 'custom_field_12',
					'customfield13' => 'custom_field_13',
					'customfield14' => 'custom_field_14',
					'customfield15' => 'custom_field_15',
					'customfield16' => 'custom_field_16',
					'customfield17' => 'custom_field_17',
					'customfield18' => 'custom_field_18',
					'customfield19' => 'custom_field_19',
					'customfield20' => 'custom_field_20',
                    'cardpresent' => 'card_present',
                    'cardtype' => 'card_type',
					'receipttype' => 'receipt_type',
					'responsestatuscode' => 'response_code',
					'responsestatusmsg' => 'response_message',
					'responsetransid' => 'response_transaction_id',
					'responseauthcode' => 'authorization_code',
					'transactiondate' => 'transaction_date',
					'createdate' => 'date_created',
					'moddate' => 'date_last_modified',
					'createuser' => 'created_by',
					'moduser' => 'modified_by',
					'useragent' => 'user_agent',
				);


				$array = array_values((array) $response->transactions);

				if ($array)
					$this->response = $array[0];
				else
					$this->response = array();

				break;

			case 'QuerySAFE':
                $this->mapping = array(
                    'id' => 'id',
                    'transactionid' => 'transaction_id',
                    'transactiontype' => 'transaction_type',
                    'paymenttype' => 'payment_type',
                    'amount' => 'amount',
                    'orderdescription' => 'order_description',
                    'orderid' => 'order_id',
                    'ponumber' => 'po_number',
                    'tax' => 'tax_amount',
                    'shipping' => 'shipping_amount',
                    'tipamount' => 'tip_amount',
                    'ccnumber' => 'cc_number',
                    'ccexpdate' => 'cc_exp_date',
                    'checkname' => 'ach_name',
                    'checkaba' => 'ach_routing_number',
                    'checkaccount' => 'ach_account_number',
                    'accountholdertype' => 'ach_business_or_personal',
                    'accounttype' => 'ach_checking_or_savings',
                    'seccode' => 'ach_sec_code',
                    'safeaction' => 'safe_action',
                    'responsesafeid' => 'safe_id',
                    'clerkid' => 'clerk_id',
                    'firstname' => 'first_name',
                    'lastname' => 'last_name',
                    'company' => 'company_name',
                    'address1' => 'address',
                    'address2' => 'address_2',
                    'city' => 'city',
                    'state' => 'state',
                    'zip' => 'zip',
                    'country' => 'country',
                    'phone' => 'phone',
                    'fax' => 'fax',
                    'email' => 'email',
                    'website' => 'website',
                    'shippingfirstname' => 'shipping_first_name',
                    'shippinglastname' => 'shipping_last_name',
                    'shippingcompany' => 'shipping_company_name',
                    'shippingaddress1' => 'shipping_address',
                    'shippingaddress2' => 'shipping_address_2',
                    'shippingcity' => 'shipping_city',
                    'shippingstate' => 'shipping_state',
                    'shippingzip' => 'shipping_zip',
                    'shippingcountry' => 'shipping_country',
                    'shippingemail' => 'shipping_email',
                    'shippingphone' => 'shipping_phone',
                    'shippingfax' => 'shipping_fax',
                    'shippingcarrier' => 'shipping_carrier',
                    'trackingnumber' => 'shipping_tracking',
                    'ipaddress' => 'ip_address',
                    'customfield1' => 'custom_field_1',
                    'customfield2' => 'custom_field_2',
                    'customfield3' => 'custom_field_3',
                    'customfield4' => 'custom_field_4',
                    'customfield5' => 'custom_field_5',
                    'customfield6' => 'custom_field_6',
                    'customfield7' => 'custom_field_7',
                    'customfield8' => 'custom_field_8',
                    'customfield9' => 'custom_field_9',
                    'customfield10' => 'custom_field_10',
                    'customfield11' => 'custom_field_11',
                    'customfield12' => 'custom_field_12',
                    'customfield13' => 'custom_field_13',
                    'customfield14' => 'custom_field_14',
                    'customfield15' => 'custom_field_15',
                    'customfield16' => 'custom_field_16',
                    'customfield17' => 'custom_field_17',
                    'customfield18' => 'custom_field_18',
                    'customfield19' => 'custom_field_19',
                    'customfield20' => 'custom_field_20',
                    'cardpresent' => 'card_present',
                    'cardtype' => 'card_type',
                    'receipttype' => 'receipt_type',
                    'responsestatuscode' => 'response_code',
                    'responsestatusmsg' => 'response_message',
                    'responsetransid' => 'response_transaction_id',
                    'responseauthcode' => 'authorization_code',
                    'transactiondate' => 'transaction_date',
                    'createdate' => 'date_created',
                    'moddate' => 'date_last_modified',
                    'createuser' => 'created_by',
                    'moduser' => 'modified_by',
                    'useragent' => 'user_agent',
                );
                $array = array_values((array) $response->transctions);

				if ($array)
					$this->response = $array[0];
				else
					$this->response = array();
				break;

			default:
           		throw new InvalidRequestException('Invalid op in Response.');
				break;

		} // switch op

	} // constructor()


	/************ Public Functions ************/

	// Overload to insert card_type as part of response data
	public function toArray() 
	{

		$array = parent::toArray();

		if (sizeof($array) > 0) {
			foreach ($array AS $index => $data) {
				$data['card_type'] = Agms::whatCardType($data['cc_number']);
				$array[$index] = $data;
			}
		}

		return $array;

	} // toArray()


	/************ Private Functions ************/


	/************ Destructor************/


} // ReportResponse
