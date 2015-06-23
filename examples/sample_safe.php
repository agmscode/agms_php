<h1>SAFE Usage Examples</h1>
<br /><br />
<a href="index.php">Back to Index</a>
<br /><br />
<pre>
<?php

require('init.php');

/**
 *
 * An example of adding a SAFE entry
 * 
 **/

$safe = new \Agms\SAFE();

$params = array(
			'payment_type' => 'creditcard',
			'first_name' => 'test first',
			'last_name' => 'test last',
			'cc_number' => '4111111111111111',
			'cc_exp_date' => '1220',
		);
 
$result = $safe->add($params);

$safe_id = $result['safe_id'];

var_dump($result);

unset($safe, $result);


/**
 *
 * An example of updating that new SAFE entry
 * 
 **/


$safe = new \Agms\SAFE();

$params = array(
			'safe_id' => $safe_id,
			'first_name' => 'test first updated',
			'last_name' => 'test last updated',
			'payment_type' => 'creditcard',
		);

$result = $safe->update($params);

var_dump($result);

unset($safe, $result);



/**
 *
 * An example of deleting that new SAFE entry
 * 
 **/


$safe = new \Agms\SAFE();

$params = array(
			'safe_id' => $safe_id
		);

$result = $safe->delete($params);

var_dump($result);

unset($safe, $result);

?>
</pre>
<br /><br />
<a href="index.php">Back to Index</a>