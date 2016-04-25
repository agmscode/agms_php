<h1>Transaction Usage Examples</h1>
<br /><br />
<a href="index.php">Back to Index</a>
<br /><br />
<pre>
<?php

require('init.php');



/**
 *
 * A minimalist example of a processed transaction
 * 
 **/


$trans = new \Agms\Transaction();

$params = array(
			'transaction_type' => 'sale',
			'amount' => '20.00',
			'cc_number' => '4111111111111111',
			'cc_exp_date' => '1220',
		);

$result = $trans->process($params);

var_dump($result);

unset($trans, $result);


/**
 *
 * A decline
 * 
 **/


$trans = new \Agms\Transaction();

$params = array(
			'transaction_type' => array('value' => 'sale'),
			'amount' => array('value' => '0.01'),
			'cc_number' => array('value' => '4111111111111111'),
			'cc_exp_date' => array('value' => '1220'),
		);

$result = $trans->process($params);

var_dump($result);

unset($trans, $result);


/**
 *
 * A FULL example of a processed transaction
 * 
 **/


$trans = new \Agms\Transaction();

$params = array(
			'transaction_type' => array('value' => 'sale'),
			'amount' => array('value' => '20.00'),
			'tax_amount' => array('value' => '2.00'),
			'shipping_amount' => array('value' => '3.00'),
			'order_description' => array('value' => 'big transaction detail test'),
			'order_id' => array('value' => '1AFSS224'),
			'po_number' => array('value' => '256645'),
			'first_name' => array('value' => 'Joe'),
			'last_name' => array('value' => 'Smith'),
			'company_name' => array('value' => 'Smith Enterprises'),
			'address' => array('value' => '125 Main St'),
			'address_2' => array('value' => 'Suite C'),
			'city' => array('value' => 'Blaine'),
			'state' => array('value' => 'MN'),
			'zip' => array('value' => '55443'),
			'country' => array('value' => 'US'),
			'phone' => array('value' => '222-222-2222'),
			'fax' => array('value' => '333-333-3333'),
			'email' => array('value' => 'joe@smith.com'),
			'website' => array('value' => 'www.smith.com'),
			'shipping_first_name' => array('value' => 'Joe'),
			'shipping_last_name' => array('value' => 'Smith'),
			'shipping_company_name' => array('value' => 'Smith Enterprises'),
			'shipping_email' => array('value' => 'test@test.com'),
			'shipping_address' => array('value' => '125 Main St'),
			'shipping_address_2' => array('value' => 'Suite C'),
			'shipping_city' => array('value' => 'Blaine'),
			'shipping_state' => array('value' => 'MN'),
			'shipping_zip' => array('value' => '55443'),
			'shipping_country' => array('value' => 'US'),
            'shipping_email' => array('value' => 'joe@smith.com'),
			'shipping_phone' => array('value' => '444-444-4444'),
			'shipping_fax' => array('value' => '555-555-5555'),
			'shipping_carrier' => array('value' => 'ups'),
			'ip_address' => array('value' => '128.101.101.101'),
			'shipping_tracking_number' => array('value' => '1Z223452433282822'),
			'custom_field_1' => array('value' => 'custom 1'),
			'custom_field_2' => array('value' => 'custom 2'),
			'custom_field_3' => array('value' => 'custom 3'),
			'custom_field_4' => array('value' => 'custom 4'),
			'custom_field_5' => array('value' => 'custom 5'),
			'custom_field_6' => array('value' => 'custom 6'),
			'custom_field_7' => array('value' => 'custom 7'),
			'custom_field_8' => array('value' => 'custom 8'),
			'custom_field_9' => array('value' => 'custom 9'),
			'custom_field_10' => array('value' => 'custom 10'),
			'cc_number' => array('value' => '4111111111111111'),
			'cc_exp_date' => array('value' => '1220'),
		);

$result = $trans->process($params);

var_dump($result);

unset($trans, $result);


?>
</pre>
<br /><br />
<a href="index.php">Back to Index</a>