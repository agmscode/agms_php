<?php

/**
 *
 * API object for the Hosted Payment Page API
 * Creates HPP Hashes for HPP links
 * 
 * HPP Requires the following fields:
 * 		Transaction Type
 * 		Gateway Username
 * 		Gateway Password
 * 		
 * @package    AGMS Gateway PHP Library
 * @subpackage HPP
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 *
 **/

namespace Agms;

class HPP extends Agms 
{


	/************ Object Variables ************/
	protected $hash; // Last generated hash

	protected $api_url = 'https://gateway.agms.com/roxapi/AGMS_HostedPayment.asmx?WSDL';
	protected $requestObject = '\Agms\Request\HPPRequest';
	protected $responseObject = '\Agms\Response\HPPResponse';


	/************ Constructor ************/



	/************ Public Functions ************/
	public function generate($params) 
	{

		$this->op = 'ReturnHostedPaymentSetup';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // generate()


	public function getLink() 
	{

		if (!$this->hash) {
			throw new \Agms\Exception\UnexpectedException('Requested HPP link but no hash generated in HPP.');
		} else {

			$formatField = $this->request->getField('HPPFormat');

			if ($formatField['value']) {

				if ($formatField['value'] == '1')
					return 'https://gateway.agms.com/HostedPaymentForm/HostedPaymentPage.aspx?hash=' . $this->hash;
				else
					return 'https://gateway.agms.com/HostedPaymentForm/HostedPaymentPage2.aspx?hash=' . $this->hash;

			} else {

				if (\Agms\Utility\Settings::$Hpp_Template == 'TEMPLATE_1')
					return 'https://gateway.agms.com/HostedPaymentForm/HostedPaymentPage.aspx?hash=' . $this->hash;
				else
					return 'https://gateway.agms.com/HostedPaymentForm/HostedPaymentPage2.aspx?hash=' . $this->hash;

			}

		}

	} // getLink()


	/************ Private Functions ************/
	private function execute() 
	{

		switch ($this->op) {

			case 'ReturnHostedPaymentSetup':

				$this->doConnect('ReturnHostedPaymentSetup', 'ReturnHostedPaymentSetupResponse');

				$this->hash = $this->response->getHash();

			break;

			default:
				throw new \Agms\Exception\InvalidRequestException('Invalid request to HPP API ' . $this->op);
			break;

		} // op

	} // execute()


	/************ Destructor************/


} // HPP
