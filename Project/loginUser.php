<!DOCTYPE html>
<html>

<?php
	session_start();

	
	$username;
	$userPassword;
	
	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		echo "get method";
		header("Location: login.php");
		die();
	}
	
	//already verify with javascript and know it's post, why do this?
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if((isset($_POST["username"])) && (isset($_POST["password"])))
		{
			$username = $_POST["username"];
			$userPassword = $_POST["password"];
		}
		else 
		{
			header("Location: login.php");
			die();
		}
	}
	
$host = "cosc360.ok.ubc.ca";
			$database = "db_24604143";
			$user = "24604143";
			$password = "24604143"; 



$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else
{
	
	$sql = "SELECT * FROM user";
	

    $results = mysqli_query($connection, $sql);

    //and fetch requsults
    while ($row = mysqli_fetch_assoc($results))
    {
	  if($row['Username'] === $username && $row['Password'] === $userPassword)//user found and validated
	  {
		  $_SESSION['userID'] = $row['ID'];//signifies user logged in
		  header("Location: homepage.php");
		 die();
	  }
    }
	echo "<p>Login Failed <a href=\"Login.php\">Go Back</a></p>";
	
}
?>
</html>
