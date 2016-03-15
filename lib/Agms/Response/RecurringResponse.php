<?php

/**
 *
 * Captures response data from Recurring API request
 *
 * @package    AGMS
 * @subpackage Recurring
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Response;

class RecurringResponse extends Response 
{

	/************ Object Variables ************/
	protected $response;


	/************ Constructor ************/
	public function __construct($response, $op) 
	{

		$this->op = $op;

		switch ($this->op) {

			case 'RetrieveRecurringID':
                $this->mapping = array(
					'id' => 'id',
                );

                $array = array_values((array) $response->recurringlist);

                if ($array)
					$this->response = $array[0];
				else
					$this->response = array();
				break;

			case 'RecurringAdd':
                $this->mapping = array(
					'RESULT' => 'response_code',
					'MSG' => 'response_message',
					'RecurringID' => 'recurring_id',
                );

				$this->response = $response;

				if (!$this->isSuccessful()) {
					$responseArray = $this->toArray();
					throw new \Agms\Exception\ResponseException('Recurring Add failed with error code ' . $responseArray['response_code'] . ' and message ' . $responseArray['response_message']);
				}

				break;

			default:
           		throw new \Agms\Exception\InvalidRequestException('Invalid op in Response.');
				break;

		} // switch op

	} // constructor()


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


} // RecurringResponse
