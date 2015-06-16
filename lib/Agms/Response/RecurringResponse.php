<?php

/**
 *
 * Captures response data from Recurring API request
 *
 * @package    AGMS
 * @subpackage Recurring
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Response;

class RecurringResponse extends Response 
{

	/************ Object Variables ************/
	protected $response;


	/************ Constructor ************/
	public function __construct($response, $op) 
	{

		$this->op = $op;

		switch ($this->op) {

			case 'RetrieveRecurringID':
                $this->mapping = array(
					'id' => 'id',
                );

                $array = array_values((array) $response->recurringlist);

                if ($array)
					$this->response = $array[0];
				else
					$this->response = array();
				break;

			default:
           		throw new \Agms\Exception\InvalidRequestException('Invalid op in Response.');
				break;

		} // switch op

	} // constructor()


	/************ Public Functions ************/



	/************ Private Functions ************/


	/************ Destructor************/


} // RecurringResponse
