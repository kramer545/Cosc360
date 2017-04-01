<!DOCTYPE html>
<html>
<script type="text/javascript" src="scripts/email.js"></script>
<body>

<?php
	session_start();

	
	$username;
	$userPassword;
	$email;
	
	if(!isset($_SESSION['userID']))
	{
		header("location: homepage.php");
		die();
	}
	
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		echo"<p>post method</p>";
		if((isset($_POST["password"])))
		{
			echo"<p>email is set</p>";
			$userPassword = $_POST["password"];
			
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
				echo"<p>connected to sql</p>";
				$sql = "UPDATE user SET Password = ? WHERE ID = ?";
				if($statement = mysqli_prepare($connection, $sql))
				{
					mysqli_stmt_bind_param($statement,'ss',$userPassword,$_SESSION['userID']);
					mysqli_stmt_execute($statement);
					header("location: Profile.php");
					die();
				}
			}
		}
	}
?>
</html>
