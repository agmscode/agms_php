<?php
/**
 * Raised when authorization fails
 *
 * @package    AGMS
 * @subpackage Exception
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 */


/**
 * Raised when the API key being used is not authorized to perform
 * the attempted action according to the roles assigned to the user
 * who owns the API key.
 */

namespace Agms\Exception;

class AuthorizationException extends AgmsException 
{

}
