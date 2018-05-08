#!/usr/bin/php
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$sessionId)
{

	 //sessionId should = Login at this point


return true;
}

	
function doValidate($sessionId){

	//$sessionId should == "validate_session"

	
	return false;
}


function requestProcessor($request)
{
	echo "received request".PHP_EOL;

  	var_dump($request);

  	if(!isset($request['type'])){

		return "ERROR: unsupported message type"; }


	switch ($request['type']){

		case "Login":
      		return doLogin($request['username'],$request['sessionId']);

		case "validate_session":
      		return doValidate($request['sessionId']); }


	return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

//echo $request['sessionId'];
$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');

exit();

?>

