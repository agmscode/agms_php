<?php

/**
 *
 * Class to manage web service requests and responses
 *
 * @package    AGMS Gateway PHP Library
 * @subpackage Connect
 * @copyright  2014 Avant-Garde Marketing Solutions, Inc.
 * 
 **/

namespace Agms\Utility;

class Connect
{

	/************ Object Variables ************/
	private $transport_method;


	/************ Constructor ************/
	public function __construct() 
    {

		if (class_exists('SOAPClient') && (\Agms\Utility\Settings::$Transport_Method == 'SOAPCLIENT'))
			$this->transport_method = 'SOAPCLIENT';
		else
			$this->transport_method = 'CURL';

	} // constructor()


	/************ Static Functions ************/
	public static function sanitize($value) 
    {

		return htmlspecialchars($value, ENT_QUOTES, "UTF-8");

	} // sanitize()


	/************ Public Functions ************/
	public function connect($url, $request, $requestmethod, $responseobject) 
    {

		if ($this->transport_method == 'SOAPCLIENT') {

			// SOAPClient

			try {

				$agms = $this->soapInit($url);

                if($this->getParameterName($requestmethod))
                    $response = $agms->$requestmethod(array($this->getParameterName($requestmethod) => $request));
                else
                    $response = $agms->$requestmethod($request);

			    if (\Agms\Utility\Settings::$Verbose) {
                    echo "REQUEST:\n\n" . htmlentities(str_ireplace('><', ">\n<", $agms->__getLastRequest())) . "\n\n";
					echo "RESPONSE:\n\n" . htmlentities(str_ireplace('><', ">\n<", $agms->__getLastResponse())) . "\n\n";
                }

			} catch (\SoapFault $e) {

			    if (\Agms\Utility\Settings::$Debug) {
					echo 'EXCEPTION: ' . $e->getMessage();
			    }

			    $this->throwStatusCodeException($e->faultcode, $e->getMessage());

			}

		} else {

			// CURL

            if($this->getParameterName($requestmethod))
                $requestArray = array($this->getParameterName($requestmethod) => $request);
            else
                $requestArray = $request;

            // Craft the XML request body for the request
			$requestBody = $this->createRequestBody(
								$requestArray, 
								'<' . $requestmethod . ' xmlns="https://gateway.agms.com/roxapi/">',
								'</' . $requestmethod . '>'
							);

			if (empty($requestBody))
				throw new \Agms\Exception\ClientErrorException('Empty request body.');

			$header = $this->buildCurlHeader(strlen($requestBody));
			$header[] = 'SOAPAction: https://gateway.agms.com/roxapi/' . $requestmethod;

			$curl = $this->curlInit($url, $header);
	        
            curl_setopt($curl, CURLOPT_POSTFIELDS, $requestBody);

            if (\Agms\Utility\Settings::$Verbose) {
                echo 'REQUEST BODY: ' . htmlentities(str_ireplace('><', ">\n<", $requestBody));
            }

	        $response = curl_exec($curl);
            $curlCode = curl_errno($curl);

            if ($curlCode != CURLE_OK) {

                    if (\Agms\Utility\Settings::$Debug) {
                        echo 'CURL ERROR: ' . curl_error($curl);
                    }

                    curl_close($curl);

                    $this->throwCurlCodeException($curlCode, curl_error($curl));

            } else {

    	        $statuscode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                if (\Agms\Utility\Settings::$Verbose) {
                    echo 'RESPONSE: ' . htmlentities(str_ireplace('><', ">\n<", $response));
                }
                
                if ($statuscode == 0) {
                    throw new \Agms\Exception\SSLCertificateException();
                }

    	        if ($statuscode === 200 || $statuscode === 201 || $statuscode === 202) {

    		        curl_close($curl);

                    $response = str_replace('&lt;', '<', $response);
                    $response = str_replace('&gt;', '>', $response);

                    $responseresult = $requestmethod . 'Result';

    		        $obj = new \SimpleXMLElement($response);
    		        $obj = $obj->xpath('//soap:Body');
                    $response = $obj[0]->$responseobject->$responseresult;

    	        } else {

        		    if (\Agms\Utility\Settings::$Debug) {
        		    	echo 'CURL ERROR: ' . curl_error($curl);
        		    }

    		        curl_close($curl);

    	            $this->throwStatusCodeException($statuscode);
    	        }

            }

		} // transport_method


		return $response;

	} // connect()


	/************ Private Functions ************/
    private function throwStatusCodeException($statusCode, $message=null) 
    {
      
        switch ($statusCode) {
         case 401:
            throw new \Agms\Exception\AuthenticationException();
            break;
         case 403:
             throw new \Agms\Exception\AuthorizationException($message);
            break;
         case 404:
             throw new \Agms\Exception\NotFoundException();
            break;
         case 426:
             throw new \Agms\Exception\UpgradeRequiredException();
            break;
         case 500:
             throw new \Agms\Exception\ServerErrorException();
            break;
         case 503:
             throw new \Agms\Exception\DownForMaintenanceException();
            break;
         case 'Client':
             throw new \Agms\Exception\ClientErrorException($message);
            break;
         default:
            throw new \Agms\Exception\UnexpectedException('Unexpected HTTP_RESPONSE #' . $statusCode . ' ' . $message);
            break;
        } // switch

    } // throwStatusCodeException()


    private function throwCurlCodeException($curlCode, $message=null) 
    {
      
        switch ($curlCode) {
         case CURLE_SSL_CONNECT_ERROR:
         case CURLE_SSL_ENGINE_NOTFOUND:
         case CURLE_SSL_ENGINE_SETFAILED:
         case CURLE_SSL_CERTPROBLEM:
         case CURLE_SSL_CIPHER:
         case CURLE_SSL_CACERT:
            throw new \Agms\Exception\SSLCertificateException($message);
            break;
         case CURLE_URL_MALFORMAT:
         case CURLE_URL_MALFORMAT_USER:
         case CURLE_BAD_CONTENT_ENCODING:
            throw new \Agms\Exception\ClientErrorException($message);
            break;
        case CURLE_UNSUPPORTED_PROTOCOL:
        case CURLE_COULDNT_RESOLVE_PROXY:
        case CURLE_COULDNT_RESOLVE_HOST:
        case CURLE_COULDNT_CONNECT:
        case CURLE_TOO_MANY_REDIRECTS:
        case CURLE_GOT_NOTHING:
        case CURLE_SEND_ERROR:
        case CURLE_RECV_ERROR:
        case CURLE_PARTIAL_FILE:
        case CURLE_HTTP_NOT_FOUND:
        case CURLE_WRITE_ERROR:
        case CURLE_READ_ERROR:
        case CURLE_OPERATION_TIMEOUTED:
        case CURLE_HTTP_RANGE_ERROR:
        case CURLE_HTTP_POST_ERROR:
        case CURLE_HTTP_PORT_FAILED:
            throw new \Agms\Exception\ConnectionException($message);
            break;
        case CURLE_FAILED_INIT:
        case CURLE_OUT_OF_MEMORY:
         default:
            throw new \Agms\Exception\UnexpectedException('Unexpected Curl Error #' . $statusCode . ' ' . $message);
            break;
        } // switch

    } // throwCurlCodeException()


    private function soapInit($url) 
    {

	    $ua = array(
	        'http'=>array(
	            'user_agent' => \Agms\Utility\Settings::$Ua_String . ' (AGMS PHP Lib ' . \Agms\Agms::getLibraryVersion() . ')'
	            )
	        );

	    $context = stream_context_create($ua);

	    $opts = array(
					'stream_context' => $context, 
					'cache_wsdl' => WSDL_CACHE_NONE, 
					'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
					'encoding'=>'utf-8'
				);

	    if (\Agms\Utility\Settings::$Debug)
	    	$opts['trace'] = 1;

		$agms = new \SoapClient($url, $opts);

		return $agms;

    } // soapInit()


    private function buildCurlHeader($length) 
    {

	        return array(
	            'Accept: application/xml',
	            'Content-Type: text/xml; charset=utf-8',
	            'User-Agent: ' . \Agms\Utility\Settings::$Ua_String . ' (AGMS PHP Lib ' . \Agms\Agms::getLibraryVersion() . ')',
	            'X-ApiVersion: ' . \Agms\Agms::getAPIVersion(),
				'Content-length: ' . $length
	        );

    } // buildCurlHeader()


    private function curlInit($url, $header) 
    {

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        
        if (\Agms\Utility\Settings::$Debug)
        	curl_setopt($curl, CURLOPT_VERBOSE, true);

        return $curl;

    } // curlInit()


    /**
     * arrays passed to this method should have a single root element
     * with an array as its value
     * @param array $array the array of data
     * @return var XML string
     */
    private function createRequestBody($array, $headerline, $footerline) 
    {

        $writer = new \XMLWriter();
        $writer->openMemory();

        $writer->setIndent(true);
        $writer->setIndentString(' ');
        $writer->startDocument('1.0', 'UTF-8');
        // header
        $header = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Body>
            ' . $headerline . '
            ';

        $writer->writeRaw($header);

        if(sizeof($array) == 1) {

            // The request is inside of an envelope (objparameters, vparameter)

            // get the root element name
            $keys = array_keys($array);
            $rootElementName = $keys[0];

            // open the root element
            $writer->startElement($rootElementName);

            // create the body
            $this->createElements($writer, $array[$rootElementName], $rootElementName);

            // close the root element and document
            $writer->endElement();

        } else {

            // There is no envelope, the array that we have is all of the data elements
            $this->createElements($writer, $array);

        }

        // footer
        $footer = $footerline . '
                </soap:Body>
            </soap:Envelope>';

        $writer->writeRaw($footer);
        $writer->endDocument();

        // send the output as string
        return $writer->outputMemory();

    } // createRequestBody()


    private function getParameterName($requestmethod) {

        switch ($requestmethod) {

            case 'AddToSAFE':
            case 'UpdateSAFE':
            case 'DeleteFromSAFE':
                return 'vParameter';
                break;

            case 'RecurringAdd':
            case 'RecurringDelete':
            case 'RecurringUpdate':
            case 'RetrieveRecurringID':
                return 'vRecurringParams';
                break;

            case 'RetrieveRecurringRecords':
                return 'vRecurringSearchParams';
                break;

            case 'QuerySAFE':
                return '';
            break;

            default:
                return 'objparameters';
                break;

        }

    } // getParameterName()


    private static function createElements(&$writer, $array) 
    {
       
        if (!is_array($array)) {
        
            if (is_bool($array)) {
                $writer->text($array ? 'true' : 'false');
            } else {
                $writer->text($array);
            }
         
          return;
        
        }
        
        foreach ($array AS $index => $element) {
            
            // convert the style back to gateway format
            $elementName = $index;

            if ($element === true)
            	$element = 'true';
           	if ($element === false)
           		$element = 'false';

            // handle child elements
            $writer->startElement($elementName);
            
            if (is_array($element)) {
                
                if (array_key_exists(0, $element) || empty($element)) {
            
                    $writer->writeAttribute('type', 'array');

                    foreach ($element AS $ignored => $itemInArray) {
                        $writer->startElement('item');
                        $this->createElements($writer, $itemInArray);
                        $writer->endElement();
                    }
            
                } else {
                    $this->createElements($writer, $element);
                }
            
            } else {

                $writer->text($element);
            
            }
            
            $writer->endElement();
        
        }

    } // createElements()


	/************ Destructor************/


} // Connect
