#!/usr/bin/php

<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('DBA.php');
echo "testRMQClient";

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{

	$un = $_POST['user'];
	$ps = $_POST['pass'];
		
	$type = getCredentials($un,$ps);

	if($type == "Login"){$msg = "Access"; }

	else {$msg = "Deny";}	

}


$request = array();
$request['type'] = $type;
$request['username'] = $user;
$request['password'] = $pass;
$request['message'] = $msg;
$request['sessionId'] = $type;


$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
print_r($response);

//echo $argv[0]." END".PHP_EOL;

//Access is suppose to go to Diego
if($request['message'] == "Access"){ header("refresh:1; url = 'http://10.0.1.8/recipeSearch.html'"); }

if($request['message'] == "Deny"){ header("refresh:1; url = 'http://10.0.1.8/register.html'"); }


exit();

?>
