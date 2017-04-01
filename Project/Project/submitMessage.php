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
	
	if(isset ($_SESSION['threadID']))
	{
		$threadID = $_SESSION['threadID'];
	}
	
	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		echo "get method";
		header("Location: login.php");
	}
	
	//already verify with javascript and know it's post, why do this?
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if((isset($_POST["post"])))
		{
			$text = $_POST["post"];
		}
		else //DO SOMETHING HERE
		{
			echo "post or threadID not found";
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
	
	if($userID != 2)
	{
			//good connection, so do your thing
		$sql = "SELECT * FROM user WHERE ID = ".$userID."";
		echo $userID;

		$results = mysqli_query($connection, $sql);

		//and fetch results
		while ($row = mysqli_fetch_assoc($results))//search all users to see if there are already in database
		{
		  $username = $row['Username'];
		}
	}
	else
		$username = "Anonymous";
	
	$sql = "INSERT INTO message (ThreadID, UserID,Post,Username) VALUES (?,?,?,?)";
	if($statement = mysqli_prepare($connection, $sql))
	{
		mysqli_stmt_bind_param($statement,'ssss',$threadID,$userID,$text,$username);//change password
		mysqli_stmt_execute($statement);
		header("Location: Thread.php");
	}
}
?>
</html>
