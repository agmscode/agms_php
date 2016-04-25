<h1>HPP Usage Examples</h1>
<br /><br />
<a href="index.php">Back to Index</a>
<br /><br />
<pre>
<?php

require('init.php');


/**
 *
 * A minimalist example of a quick $20 payment page with template 1
 * 
 **/

$hpp = new \Agms\HPP();

$params = array(
			'transaction_type' => array('value' => 'sale'),
			'amount' => array('value' => '20.00'),
			'first_name' => array('setting' => 'required'),
			'last_name' => array('setting' => 'required'),
			'zip' => array('setting' => 'required'),
			'email' => array('setting' => 'required'),
			'hpp_format' => array('value' => '1'),
			'your_custom_field_name_1' => array('value' => 'test custom', 'setting' => 'required'),
		);

$result = $hpp->generate($params);

echo "\n\n" . 'Quick $20 payment page: <a href="' . $hpp->getLink() . '" target="_blank">' . $hpp->getLink() . "</a>\n\n";
var_dump($result);

unset($hpp, $result);


/**
 *
 * A more comprehensive example for myagms.com express portal pages
 * 
 **/

$hpp = new \Agms\HPP();

$params = array(
			'transaction_type' => array('value' => 'sale'),
			'amount' => array('value' => '37.08'),
			'first_name' => array('value' => 'Joe', 'setting' => 'disabled'),
			'last_name' => array('value' => 'Smith', 'setting' => 'disabled'),
			'zip' => array('value' => '55418', 'setting' => 'disabled'),
			'email' => array('value' => 'jsmith@test.com', 'setting' => 'disabled'),
			'tax_amount' => array('value' => '2.09', 'setting' => 'disabled'),
			'shipping_amount' => array('value' => '5.00', 'setting' => 'disabled'),
			'address' => array('value' => '123 Main St.', 'setting' => 'disabled'),
			'city' => array('value' => 'Dallas', 'setting' => 'disabled'),
			'state' => array('value' => 'TX', 'setting' => 'disabled'),
			'phone' => array('value' => '555-555-5555', 'setting' => 'disabled'),
			'order_id' => array('value' => '123232', 'setting' => 'disabled'),
			'description' => array('value' => 'Eyeglass Repair', 'setting' => 'disabled'),
			'shipping_first_name' => array('value' => 'Joe', 'setting' => 'disabled'),
			'shipping_last_name' => array('value' => 'Smith', 'setting' => 'disabled'),
			'shipping_email' => array('value' => 'test@test.com', 'setting' => 'disabled'),
			'shipping_zip' => array('value' => '55418', 'setting' => 'disabled'),
			'shipping_address' => array('value' => '123 Main St.', 'setting' => 'disabled'),
			'shipping_city' => array('value' => 'Dallas', 'setting' => 'disabled'),
			'shipping_state' => array('value' => 'TX', 'setting' => 'disabled'),
			'shipping_tracking_number' => array('value' => '1Z23990203949283910', 'setting' => 'disabled'),
			'shipping_carrier' => array('value' => 'UPS', 'setting' => 'disabled'),
		);

$result = $hpp->generate($params);

echo "\n\n" . 'Express payment page generator example: <a href="' . $hpp->getLink() . '" target="_blank">' . $hpp->getLink() . "</a>\n\n";
var_dump($result);

unset($hpp, $result);


/**
 *
 * Redirect and auto add to safe Test
 *   [authcode] => 9999
 *   [avsmsg] => 
 *   [transid] => 408978
 *   [authmsg] => Approved
 *   [statuscode] => 1
 *   [avscode] => 
 *   [cvv2code] => 
 *   [cvv2msg] => 
 *   [safeid] => 
 *   [statusmsg] => Approved
 **/

$hpp = new \Agms\HPP();

$params = array(
			'transaction_type' => array('value' => 'sale'),
			'amount' => array('value' => '20.00'),
			'first_name' => array('setting' => 'required'),
			'last_name' => array('setting' => 'required'),
			'zip' => array('setting' => 'required'),
			'email' => array('setting' => 'required'),
			'enable_auto_add_to_safe' => array('value' => 'true'),
			'return_url' => array('value' => 'http://dev02.agmsdallas.com/agms_php/mike/redirect_landing.php'),
		);

$result = $hpp->generate($params);

echo "\n\n" . 'Redirect test: <a href="' . $hpp->getLink() . '" target="_blank">' . $hpp->getLink() . "</a>\n\n";
var_dump($result);

unset($hpp, $result);

/*
Array
(
    [authcode] => 9999
    [avsmsg] => 
    [transid] => 408241
    [authmsg] => Approved
    [statuscode] => 1
    [avscode] => 
    [cvv2code] => 
    [cvv2msg] => 
    [safeid] => 
    [statusmsg] => Approved
)
Array
(
)

 */

?>
</pre>
<br /><br />
<a href="index.php">Back to Index</a>