<?php

/**
 *
 * Captures response data from Boarding API request
 *
 * @package    AGMS
 * @subpackage Boarding
 * @copyright  2016 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Response;

class BoardingResponse extends Response 
{

	/************ Object Variables ************/
	protected $response;
	protected $boardingResult;


	/************ Constructor ************/	
	public function __construct($response, $op) 
	{

        $this->op = $op;

		switch ($this->op) {

			case 'BoardMerchant':

				$this->mapping = array(
					'BoardingAPI' => 'response',
					'Code' => 'response_code',
					'Error' => 'error',
					'Message' => 'response_message',
					'ValidationError' => 'validation_error',
					'ValidationMessages' => 'validation_messages',
					'ValidationMessage' => 'validation_message',
					'Exception' => 'exception',
				);


				$this->response = $response;

				$responseArray = $this->toArray();
				$this->boardingResult = $responseArray['response'];

				if (!$this->isSuccessful()) {

					// There are a few different structures to a response message when the request was unsuccessful, use conditionals to build detailed exception message
					$exceptionmessage = 'Merchant Boarding failed with error code ' . $this->boardingResult['response_code'];
					if(@$this->boardingResult['validation_error']['response_message'])
						$exceptionmessage .= ' and message "' . $this->boardingResult['validation_error']['response_message'] . '"';
					if(@$this->boardingResult['error']['response_message'])
						$exceptionmessage .= ' and message "' . $this->boardingResult['error']['response_message'] . '"';
					if(@$this->boardingResult['validation_error']['validation_messages']['validation_message'])
						$exceptionmessage .= ' with details "' . $this->boardingResult['validation_error']['validation_messages']['validation_message'] . '"';
					if(@$this->boardingResult['error']['exception'])
						$exceptionmessage .= ' with details "' . $this->boardingResult['error']['exception'] . '"';
					$exceptionmessage .= '.';

					throw new \Agms\Exception\ResponseException($exceptionmessage);

				}

				break;

			case 'RetrieveAgentStoredPricing':
                $this->mapping = array(

                );

				$this->response = $response;


			default:
           		throw new \Agms\Exception\InvalidRequestException('Invalid op in Response.');
				break;

		} // switch op


	} // constructor()


	/************ Public Functions ************/
	public function isSuccessful() 
	{

		$code = $this->boardingResult['response_code'];

		// We do not throw exceptions on declines, as that has nothing to do with the request or the gateway
		if (($code != '1') && ($code != '1.5')) {
			return false;
		}

		return true;

	} // isSuccessful()


	/************ Private Functions ************/


	/************ Destructor************/


} // BoardingResponse
