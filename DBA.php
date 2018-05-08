<?PHP

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

require("RCS.php"); 
session_start();

function getCredentials($un, $ps){

$_SESSION["username"] = $un;
$_SESSION["password"] = $ps;


	//DB admin
        $host = "10.0.1.6";
        $dbus = "mk694";
        $dbps = "testmk694";
        $dbss = "userlogin";

        //DB connection & query
        $conn = mysqli_connect($host, $dbus, $dbps, $dbss);
        $query = mysqli_query($conn, "SELECT * from user WHERE Username = '$un' && Password='$ps'");

        // check CREDENTIALS
        $rows = mysqli_num_rows($query);

        if($rows == 1){
                echo"LOADING....";
		$type = "Login";
		$_SESSION["type"] = "Login";
		
		return $type; }
		
	else{ 
		echo"Loading...";
		$type = "validate_session";		
		$_SESSION["type"] = "validate_session";
		
		return $type; }

mysqli_close($conn);

}

function getThis($recipe){

//Access DB

       //DB admin
        $host = "10.0.1.6";
	$dbus = "mk694";
        $dbps = "testmk694";
        $dbss = "userlogin";
	
        //DB connection & query
        $conn = mysqli_connect($host, $dbus, $dbps, $dbss);

	if (!$conn) { die("Connection failed: " . mysqli_connect_error()); } 
 
	$Res = "SELECT * FROM Recipes WHERE Title = '$recipe'";
	$result = mysqli_query($conn, $Res);
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				echo "The Recipe Title is: ". $row["Title"]. "<br>";
				echo "The Recipe is: ". $row["Recipes"]. "<br>";

				$bonApetit = $row["Recipes"];
				header("refresh:1;url = $bonApetit");
				return $row['Recipes'];				
				 }

		 } 


		else {
					
			$rows = array();
			
			$rows['title'] = $recipe;
			$rows['ingred']	= getRecipe($recipe);
			$Ingred = $rows["ingred"];
			
			echo '<br>';
			echo "One moment..."; 
     			

        		$TitleList = "INSERT INTO Recipes(Title, Recipes) VALUES('$recipe', '$Ingred')";
			$result = mysqli_query($conn, $TitleList);


		}

mysqli_close($conn);

}


	
?>
