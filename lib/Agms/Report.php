<?php

/**
 *
 * API object for the Reporting/Query API
 * 		
 *
 * @package    AGMS Gateway PHP Library
 * @subpackage Reporting
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 *
 * 
 **/

namespace Agms;

use \Agms\Exception\InvalidRequestException;

class Report extends Agms 
{

	/************ Object Variables ************/
	protected $trans_api_url = 'https://gateway.agms.com/roxapi/agms.asmx?WSDL';
	protected $safe_api_url = 'https://gateway.agms.com/roxapi/AGMS_SAFE_API.asmx?WSDL';
	protected $requestObject = '\Agms\Request\ReportRequest';
	protected $responseObject = '\Agms\Response\ReportResponse';

	/************ Constructor ************/


	/************ Public Functions ************/
	public function listTransactions($params) 
	{

		$this->op = 'TransactionAPI';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();
        return $this->response->toArray();
		
	} // listTransactions()


	public function listSAFEs($params) 
	{

		$this->op = 'QuerySAFE';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();
		
	} // listSAFEs()




	/************ Private Functions ************/
	private function execute() 
	{

		switch ($this->op) {

			case 'TransactionAPI':
			
				$this->api_url = $this->trans_api_url;

				$this->doConnect('TransactionAPI', 'TransactionAPIResponse');

				break;

			case 'QuerySAFE':
			
				$this->api_url = $this->safe_api_url;

				$this->doConnect('QuerySAFE', 'QuerySAFEResponse');

				break;

			default:
				throw new InvalidRequestException('Invalid request to Reporting API ' . $this->op);
				break;

		} // op

	} // execute()


	/************ Destructor ************/


} // Report
