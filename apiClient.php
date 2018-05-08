#!/usr/bin/php

<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require('DBA.php');

$client = new rabbitMQClient("testRabbitMQ.ini","api");

if (isset($argv[1]))
{
 	$msg = $argv[1];
}
else
{
	//Try to access DB from here

	$seekDB = $_POST['RS'];
	
	$request = array();
	$request['title'] = $seekDB;
	$request['procedure'] = "";

	
	$request['procedure'] = getThis($request['title']);

	echo "Client: ";
	
	echo '<br><br>';
   
}

$request = json_encode($request);

$response = $client->send_request($request);
//$response = $client->publish($apiRequest);

echo "client received response: ".PHP_EOL;
//print_r($response);

//echo $argv[0]." END".PHP_EOL;

//header("refresh:10;url = 'http://10.0.1.6/goFind.php'");
//header("refresh:4; url = '$_SESSION['url]'"); }

//echo $apiRequest;
echo "DONE!!";
exit();

?>
