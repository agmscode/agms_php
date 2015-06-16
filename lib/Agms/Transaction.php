<?php

/**
 *
 * API object for the Transaction API
 * 		
 *
 * @package    AGMS Gateway PHP Library
 * @subpackage Transaction
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 *
 * 
 **/

namespace Agms;

use \Agms\Exception\InvalidRequestException;

class Transaction extends Agms 
{

	/************ Object Variables ************/
	protected $api_url = 'https://gateway.agms.com/roxapi/agms.asmx?WSDL';
	protected $requestObject = '\Agms\Request\TransactionRequest';
	protected $responseObject = '\Agms\Response\TransactionResponse';


	/************ Constructor ************/


	/************ Public Functions ************/
	public function process($params) 
	{

		$this->op = 'ProcessTransaction';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // process()


	/************ Private Functions ************/
	private function execute() 
	{

		switch($this->op) {

			case 'ProcessTransaction':
			
				$this->doConnect('ProcessTransaction', 'ProcessTransactionResponse');
		
				break;

			default:
				throw new InvalidRequestException('Invalid request to Transaction API ' . $this->op);
				break;

		} // op

	} // execute()


} // Transaction
