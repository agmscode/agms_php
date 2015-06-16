<?php

/**
 *
 * Captures response data from Transaction API request
 *
 * @package    AGMS
 * @subpackage Response
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Response;

use \Agms\Exception\ResponseException;

class TransactionResponse extends Response 
{

	/************ Object Variables ************/
	protected $response;
	protected $mapping = array(
			'STATUS_CODE' => 'response_code',
			'STATUS_MSG' => 'response_message',
			'TRANS_ID' => 'transaction_id',
			'AUTH_CODE' => 'authorization_code',
			'AVS_CODE' => 'avs_result',
			'AVS_MSG' => 'avs_message',
			'CVV2_CODE' => 'cvv_result',
			'CVV2_MSG' => 'cvv_message',
			'ORDERID' => 'order_id',
			'SAFE_ID' => 'safe_id',
			'FULLRESPONSE' => 'full_response',
			'POSTSTRING' => 'post_string',
			'BALANCE' => 'gift_balance',
			'GIFTRESPONSE' => 'gift_response',
			'MERCHANT_ID' => 'merchant_id',
			'CUSTOMER_MESSAGE' => 'customer_message',
			'RRN' => 'rrn',
		);


	/************ Constructor ************/
	public function __construct($response, $op) 
	{

		$this->response = $response;
		$this->op = $op;

		if (!$this->isSuccessful()) {
			$responseArray = $this->toArray();
			throw new ResponseException('Transaction failed with error code ' . $responseArray['response_code'] . ' and message ' . $responseArray['response_message']);
		}

	}

	/************ Public Functions ************/
	public function isSuccessful() 
	{

		$responseArray = $this->toArray();
		$code = $responseArray['response_code'];

		// We do not throw exceptions on declines, as that has nothing to do with the request or the gateway
		if (($code != '1') && ($code != '2')) {
			return false;
		}

		return true;

	} // isSuccessful()


	/************ Private Functions ************/


	/************ Destructor************/


} // TransactionResponse
