<h1>Recurring Usage Examples</h1>
<br /><br />
<a href="index.php">Back to Index</a>
<br /><br />
<pre>
<?php

require('init.php');



/**
 *
 * A sample recurring add
 * 
 **/
/*
$recur = new \Agms\Recurring();

$params = array(
			'payment_type' => 'creditcard',
			'recurring_amount' => '20.00',
			'cc_number' => '4111111111111111',
			'cc_exp_date' => '1220',
			'cc_cvv' => '987',
			'first_name' => 'Test',
			'last_name' => 'Recurring',
			'email' => 'testing@agms.com',
			'start_date' => '2014-11-09',
			'end_date' => '2018-11-09',
			'frequency' => 'months',
			'number_of_retries' => '2'
		);

$result = $recur->add($params);

echo "\n\n";
var_dump($result);

unset($recur, $result);
*/

/**
 *
 * A sample recurring retrieval
 * 
 **/

$recur = new \Agms\Recurring();

$params = array(
			'merchant_id' => '969',
		);

$result = $recur->get($params);

echo "\n\n";
var_dump($result);

unset($recur, $result);

?>
</pre>
<br /><br />
<a href="index.php">Back to Index</a>