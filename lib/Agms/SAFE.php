<?php

/**
 *
 * API object for the Customer SAFE API
 * 		
 *
 * @package    AGMS Gateway PHP Library
 * @subpackage SAFE
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 *
 * 
 **/

namespace Agms;

class SAFE extends Agms 
{

	/************ Object Variables ************/
	protected $api_url = 'https://gateway.agms.com/roxapi/AGMS_SAFE_API.asmx?WSDL';
	protected $requestObject = '\Agms\Request\SAFERequest';
	protected $responseObject = '\Agms\Response\SAFEResponse';


	/************ Constructor ************/



	/************ Public Functions ************/
	public function add($params) 
	{

		$this->op = 'AddToSAFE';

		$this->resetParameters();

		$this->setParameter('SAFE_Action', array('value' => 'add_safe'));

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // add()


	public function update($params) 
	{

		$this->op = 'UpdateSAFE';

		$this->resetParameters();

		$this->setParameter('SAFE_Action', array('value' => 'update_safe'));

		foreach ($params AS $param => $config) {
            $this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // update()


	public function delete($params) 
	{

		$this->op = 'DeleteFromSAFE';

		$this->resetParameters();

		$this->setParameter('SAFE_Action', array('value' => 'delete_safe'));

		foreach ($params AS $param => $config) {

			$this->setParameter($param, $config);

		} // foreach params

		$this->execute();

		return $this->response->toArray();

	} // delete()


	/************ Private Functions ************/
	private function execute() 
	{

		switch ($this->op) {

			case 'AddToSAFE':

				$this->doConnect('AddToSAFE', 'AddToSAFEResponse');

				break;

			case 'UpdateSAFE':
			
				$this->doConnect('UpdateSAFE', 'UpdateSAFEResponse');

				break;

			case 'DeleteFromSAFE':
			
				$this->doConnect('DeleteFromSAFE', 'DeleteFromSAFEResponse');

				break;

			default:
				throw new \Agms\Exception\InvalidRequestException('Invalid request to SAFE API ' . $this->op);
				break;

		} // op

	} // execute()


} // SAFE
