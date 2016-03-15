<?php

/**
 *
 * API object for the Boarding API
 * 		
 *
 * @package    AGMS Gateway PHP Library
 * @subpackage Boarding
 * @copyright  2016 Avant-Garde Marketing Solutions, Inc.
 *
 * 
 **/

namespace Agms;

class Boarding extends Agms 
{

	/************ Object Variables ************/
	protected $api_url = 'https://gateway.agms.com/roxapi/AGMS_boarding.asmx?WSDL';
	protected $requestObject = '\Agms\Request\BoardingRequest';
	protected $responseObject = '\Agms\Response\BoardingResponse';


	/************ Constructor ************/



	/************ Public Functions ************/
	public function board($params) 
	{

		$this->op = 'BoardMerchant';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // board()


	public function getPricing($params) 
	{

		$this->op = 'RetrieveAgentStoredPricing';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // board()




	/************ Private Functions ************/
	private function execute() 
	{

		switch($this->op) {

			case 'BoardMerchant':
			
				$this->doConnect('BoardMerchant', 'BoardMerchantResponse');
		
				break;

			case 'RetrieveAgentStoredPricing':
			
				$this->doConnect('RetrieveAgentStoredPricing', 'RetrieveAgentStoredPricingResponse');
		
				break;

			default:
				throw new \Agms\Exception\InvalidRequestException('Invalid request to Boarding API ' . $this->op);
				break;

		} // op

	} // execute()


} // Boarding
