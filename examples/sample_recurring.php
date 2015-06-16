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

$recur = new \Agms\Recurring();

$params = array(
			'RecurringAmount' => array('value' => '20.00'),
			'CCNumber' => array('value' => '4111111111111111'),
			'CCExpDate' => array('value' => '1220'),
			'FirstName' => array('value' => 'Test'),
			'LastName' => array('value' => 'Recurring'),
			'StartDate' => array('value' => '2014-11-09'),
			'EndDate' => array('value' => '2018-11-09'),
			'Frequency' => array('value' => 'months'),
			'NumberOfRetries' => '2'
		);

$result = $recur->add($params);

echo "\n\n";
var_dump($result);

unset($recur, $result);

?>
</pre>
<br /><br />
<a href="index.php">Back to Index</a>