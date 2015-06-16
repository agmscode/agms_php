<?php namespace Agms;?>
<h1>Report Usage Examples</h1>
<br /><br />
<a href="index.php">Back to Index</a>
<br /><br />
<pre>
<?php
require('init.php');
use \Agms\Report;


/**
 *
 * A sample transaction report
 * 
 **/

$rep = new Report();

$params = array(
			'start_date' => array('value' => '2014-09-24'),
			'end_date' => array('value' => '2015-11-09'),
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

$rep = new Report();

$params = array(
			'StartDate' => array('value' => '2014-09-24'),
			'EndDate' => array('value' => '2014-11-03'),
		);

$report = $rep->listSAFEs($params);

echo "\n\n";
var_dump($report);

unset($rep);


?>
</pre>
<br /><br />
<a href="index.php">Back to Index</a>