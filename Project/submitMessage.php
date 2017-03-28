<!DOCTYPE html>
<html>

<p>Here are some results:</p>

<?php
	session_start();

	$userID;
	$text;
	$username;
	$threadID;
	
	if(isset($_SESSION['userID']))//already logged in
	{
		$userID = $_SESSION['userID'];
	}
	else
	{
		$userID = 2;//not logged in, anon account
	}
	
	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		echo "get method";
		header("Location: login.php");
	}
	
	//already verify with javascript and know it's post, why do this?
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if((isset($_POST["post"])) && (isset($_POST["threadID"])))
		{
			$text = $_POST["post"];
			$threadID = $_POST["threadID"];
		}
		else //DO SOMETHING HERE
		{
			echo "user/password not found";
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
	
	if(userID != 2)
	{
			//good connection, so do your thing
		$sql = "SELECT * FROM users WHERE ID = ".$userID.";";

		$results = mysqli_query($connection, $sql);

		//and fetch results
		while ($row = mysqli_fetch_assoc($results))//search all users to see if there are already in database
		{
		  $username = $row['Username'];
		}
	}
	else
		$username = "Anonymous";
	
	$sql = "INSERT INTO `message`(`ThreadID`, `UserID`,`Post`,`Username`) VALUES (".$threadID.",".$userID.",".$text.",".$username.")";
	
}
?>
</html>
