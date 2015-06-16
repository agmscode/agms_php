<?php

/**
 *
 * Captures response data from HPP request
 *
 * @package    AGMS
 * @subpackage Response
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Response;

use \Agms\Exception\ResponseException;

class HPPResponse extends Response 
{

	/************ Object Variables ************/
	protected $hash;
	protected $mapping = array(
			0 => 'hash',
		);


	/************ Constructor ************/
	public function __construct($response, $op) 
	{

		$this->op = $op;

		$this->response = array_values((array) $response);

		$this->hash = $this->response[0];
		
		if (!$this->isSuccessful()) {
			throw new ResponseException('HPP Generation failed with message ' . $this->hash);
		}

	} // constructor()


	/************ Public Functions ************/
	public function getHash() 
	{

		return $this->hash;

	} // getHash()


	public function isSuccessful() 
	{

		$hash = strtoupper($this->hash);

		if (empty($hash) || ($hash == '0') || strstr($hash, 'INVALID') || strstr($hash, 'ERROR') || 
			strstr($hash, 'EXCEPTION') || strstr($hash, 'REQUIRED') || strstr($hash, 'IF USED')
			 || strstr($hash, 'MUST BE') || strstr($hash, 'FAILED')) {
			return false;
		}

		return true;

	} // isSuccessful()


	/************ Private Functions ************/


	/************ Destructor************/


} // HPPResponse
