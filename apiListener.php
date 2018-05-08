#!/usr/bin/php

<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//This function use the apiClient.php info.
function requestProcessor($request)
{
        echo "received request".PHP_EOL;
		
	//Transfer the data from array made in apiClient.php
	var_dump($request);
	
	if($request['procedure'] == ""){ 
		echo "API search not found";
		header("refresh:3; url='http://10.0.1.8/recipeSearch.html'"); }
	
 	else{
		//Listener display result	
		echo $result; }

                                              
        //return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

//create a RabbitMQ return message
$server = new rabbitMQServer("testRabbitMQ.ini","api");

//Function to sends the return message 
$server->process_requests('requestProcessor');

exit();

?>


