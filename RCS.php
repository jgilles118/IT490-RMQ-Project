
<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

function getRecipe($this){

$seek = rawurlencode($this);
//$seek = rawurlencode("samosa");

//echo $seek;
echo '<br><br>';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://food2fork.com/api/search/get/recipes?key=4916d9636e831706cbe4839bc852ea1b&q=$seek&sort=r");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_POST, 1);


$headers = array();
$headers[] = "Content-Type: application/x-www-form-urlencoded";

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
$result = curl_exec($ch);
curl_close ($ch);
//echo $result;

$parsed = array();
$result = json_decode($result, true);
$parsed = $result['recipes']['2']['recipe_id'];


//========================================================================

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://food2fork.com/api/get?key=4916d9636e831706cbe4839bc852ea1b&rId=$parsed&sort=r");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Content-Type: application/x-www-form-urlencoded";

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

$result = curl_exec($ch);

//use $result to insert the recipe to DB
//echo $result;
curl_close ($ch);



$result = json_decode($result, true);
//print($result);

//link to a display recipe from DB
$display = $result['recipe']['source_url'];

//echo $result;

//return $result;
header("refresh:1; url = $display");
/////////////////////////////////////////


echo '<br><br>';
//echo $display;
//header("refresh:1; url = $display");
return $display;
//////////////////////////////////////////

}


?>

