<h1>Report Usage Examples</h1>
<br /><br />
<a href="index.php">Back to Index</a>
<br /><br />
<pre>
<?php

require('init.php');



/**
 *
 * A sample transaction report
 * 
 **/

$rep = new \Agms\Report();

$params = array(
			'start_date' => array('value' => '2016-03-15'),
			'end_date' => array('value' => '2016-03-15'),
		);

$report = $rep->listTransactions($params);

echo "\n\n";
var_dump($report);

unset($rep);


/**
 *
 * A sample safe report
 * 
 **/

$rep = new \Agms\Report();

$params = array(
			'StartDate' => array('value' => '2016-03-15'),
			'EndDate' => array('value' => '2016-03-15'),
		);

$report = $rep->listSAFEs($params);

echo "\n\n";
var_dump($report);

unset($rep);


?>
</pre>
<br /><br />
<a href="index.php">Back to Index</a>