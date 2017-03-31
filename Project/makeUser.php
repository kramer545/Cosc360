<!DOCTYPE html>
<html>

<p>Here are some results:</p>

<?php
	session_start();

	
	$username;
	$userPassword;
	$email;
	
	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		echo "get method";
		header("Location: login.php");
	}
	
	//already verify with javascript and know it's post, why do this?
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if((isset($_POST["username"])) && (isset($_POST["email"])) && (isset($_POST["password"])))
		{
			$username = $_POST["username"];
			$userPassword = $_POST["password"];
			$email = $_POST["email"];
		}
		else //DO SOMETHING HERE
		{
			echo "some value not found";
		}
	}
	
$host = "localhost";
$database = "db_24604143";
$user = "root";
$password = ""; 



$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else
{
	
	$sql = "INSERT INTO user (Username, Email,Password) VALUES (?,?,?)";
	if($statement = mysqli_prepare($connection, $sql))
	{
		mysqli_stmt_bind_param($statement,'sss',$username,$email,$userPassword);
		//NOT using md5 right now since when comparing the same values in another file, the two md5's dont match, and TA never got back and I'm outta time
		mysqli_stmt_execute($statement);
		header("Location: homepage.php");
		die();
	}
}
?>
</html>
