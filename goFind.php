#!https://gist.github.com/recked/7329961

<?php 
//Access DB
$un = $_SESSION['user'];
$ps = $_SESSION['pass'];
	
        //DB admin
        //$host = "10.0.1.6";
	//$dbus = "mk694";
        //$dbps = "testmk694";
        //$dbss = "userlogin";
	$host = "localhost";
	$dbus = "root";
        $dbps = "it490";
        $dbss = "Newby";

        //DB connection & query
        $conn = mysqli_connect($host, $dbus, $dbps, $dbss);
        $query = mysqli_query($conn, "SELECT * from user WHERE Username = '$un' && Password='$ps'");

        // check CREDENTIALS
        $rows = mysqli_num_rows($query);

//---------------------------------------------------------------
//Ask Mariya about this

//$query="SELECT * FROM user LIMIT 5"; 

$result=$mysqli->query($query)or die ($mysqli->error);

//store the entire response
$response = array();

//the array that will hold the recipes and links
$posts = array();

while($row=$result->fetch_assoc()) //mysql_fetch_array($sql)
{ 
	$recipes = $row['recipe']; 
	$url = $row['http://food2fork.com/api/get?key={4916d9636e831706cbe4839bc852ea1b}']; 

	//each item from the rows go in their respective vars and into the posts array
	$posts[] = array('recipe'=> $recipes, 'url'=> $url); 
}
 
//the posts array goes into the response
$response['posts'] = $posts;

//creates the file
$fp = fopen('results.json', 'w');
fwrite($fp, json_encode($response));
fclose($fp);


/* Final Output
{"posts": [
  {
    "recipes":"output_from_table",
    "url":"output_from_table"
  },  
  ...
	]

}
*/
?> 
