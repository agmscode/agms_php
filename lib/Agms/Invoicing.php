<?php

/**
 *
 * API object for the Invoicing API
 * 		
 *
 * @package    AGMS Gateway PHP Library
 * @subpackage Invoicing
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 *
 * 
 **/

namespace Agms;

use \Agms\Exception\InvalidRequestException;

class Invoicing extends Agms 
{

	/************ Object Variables ************/
	protected $api_url = 'https://gateway.agms.com/roxapi/AGMS_BillPay.asmx?WSDL';
	protected $requestObject = '\Agms\Request\InvoicingRequest';
	protected $responseObject = '\Agms\Response\InvoicingResponse';


	/************ Constructor ************/


	/************ Public Functions ************/

	public function customer($params) 
	{

		$this->op = 'RetrieveCustomerIDList';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // customer()


	public function invoice($params) 
	{

		$this->op = 'RetrieveInvoices';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // invoice()


	public function submit($params) 
	{

		$this->op = 'SubmitInvoice';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // submit()


	/************ Private Functions ************/

	private function execute() 
	{

		switch ($this->op) {

			case 'RetrieveCustomerIDList':
			
				$this->doConnect('RetrieveCustomerIDList', 'RetrieveCustomerIDListResponse');

				break;

			case 'RetrieveInvoices':
			
				$this->doConnect('RetrieveInvoices', 'RetrieveInvoicesResponse');

				break;

			case 'SubmitInvoice':
			
				$this->doConnect('SubmitInvoice', 'SubmitInvoiceResponse');

				break;


			default:
				throw new InvalidRequestException('Invalid request to Invoicing API ' . $this->op);
				break;

		} // op

	} // execute()


} // Invoicing
