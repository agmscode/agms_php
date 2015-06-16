<?php

/**
 *
 * API object for the Recurring API
 * 		
 *
 * @package    AGMS Gateway PHP Library
 * @subpackage Recurring
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 *
 * 
 **/

namespace Agms;

class Recurring extends Agms 
{

	/************ Object Variables ************/
	protected $api_url = 'https://gateway.agms.com/roxapi/AGMS_Recurring.asmx?WSDL';
	protected $requestObject = '\Agms\Request\RecurringRequest';
	protected $responseObject = '\Agms\Response\RecurringResponse';


	/************ Constructor ************/


	/************ Public Functions ************/
	public function add($params) 
	{

		$this->op = 'RecurringAdd';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // add()


	public function delete($params) 
	{

		$this->op = 'RecurringDelete';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // delete()


	public function update($params) 
	{

		$this->op = 'RecurringUpdate';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // update()


	public function get($params) 
	{

		$this->op = 'RetrieveRecurringID';

		$this->resetParameters();

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // get()


	/************ Private Functions ************/

	private function execute() 
	{

		switch ($this->op) {

			case 'RecurringAdd':
			
				$this->doConnect('RecurringAdd', 'RecurringAddResponse');

				break;

			case 'RecurringDelete':
			
				$this->doConnect('RecurringDelete', 'RecurringDeleteResponse');

				break;

			case 'RecurringUpdate':
			
				$this->doConnect('RecurringUpdate', 'RecurringUpdateResponse');

				break;

			case 'RetrieveRecurringID':
			
				$this->doConnect('RetrieveRecurringID', 'RetrieveRecurringIDResponse');

				break;

			default:
				throw new \Agms\Exception\InvalidRequestException('Invalid request to Recurring API ' . $this->op);
				break;

		} // op

	} // execute()


} // Recurring
