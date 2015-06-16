<?php

/**
 *
 * Response super object containing common objects and methods for Response classes
 *
 * @package    AGMS
 * @subpackage Response
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Response;

abstract class Response 
{

	/************ Object Variables ************/
	protected $response;
	protected $op;
	protected $mapping;


	/************ Constructor ************/
	public function __construct($response, $op) 
	{

		$this->response = $response;
		$this->op = $op;

	} // constructor()


	/************ Public Functions ************/

	public function toArray() 
	{

		$xmlObj = $this->response;

		$array = $this->objectToArray($xmlObj);

		return $this->mapResponse($array);

	} // toArray()


	/************ Protected Functions ************/
	protected function objectToArray($xmlObj, $out = array()) 
	{
		
		if (empty($xmlObj))
			return '';

		foreach ((array) $xmlObj as $index => $node) {

	        $out[$index] = (is_object($node) ? $this->objectToArray($node) : $node);
	    }

	    return $out;

	} // objectToArray()


	protected function mapResponse($array) 
	{

		if ($this->mapping) {
			
			$response = $this->doMap($array);

			return $response;

		} else {
			throw new \Agms\Exception\UnexpectedException('Response mapping not defined for this API.');
		}

	} // mapResponse()


	/************ Private Functions ************/
	private function doMap($array) 
	{

		$response = array();
		$mapping = $this->mapping;
		$i = 0;

		if ($mapping) {

			// We only map the end of the array containing data
			// If this element is an array, then we map its individual sub-arrays
			// Otherwise, we map
			foreach ($array AS $key => $value) {

				if (is_array($value)) {
					$response[] = $this->doMap($value);
				} else {

					if (!array_key_exists($key, $mapping)) {
						if (\Agms\Utility\Settings::$Debug)
							echo 'key ' . $key . ' value ' . $value . "\n";
						throw new \Agms\Exception\UnexpectedException('Unmapped field ' . $key . ' in response');
					}
					else
						$response[$mapping[$key]] = $value;
			
				}

				$i++;

			}

		} // mapping

		return $response;

	} // doMap()


	/************ Destructor************/


} // Response
