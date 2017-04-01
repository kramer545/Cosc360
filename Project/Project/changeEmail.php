<!DOCTYPE html>
<html>
<script type="text/javascript" src="scripts/email.js"></script>

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
	
	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		header("Location: homepage.php");
		die();
	}
	
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if((isset($_POST["username"])) && (isset($_POST["password"])))
		{
			$username = $_POST["username"];
			$userPassword = $_POST["password"];
			
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
				
				$sql = "UPDATE user SET Email = ? WHERE UserID = ?";
				if($statement = mysqli_prepare($connection, $sql))
				{
					mysqli_stmt_bind_param($statement,'ss',$email,$_SESSION['userID']);
					mysqli_stmt_execute($statement);
					return;
				}
				echo "<p>Email changed</p>";
			}
		}
	}
?>

	<form id = "emailForm" method="post" action="changeEmail.php"  style="overflow:auto">
	   <fieldset>
		<h3>Please enter new email to use</h3>
		<input id = "email" type = "email" size = "30" name = "email"/>
		<br><br>
		<h3>Enter email again</h3>
		<input id = "email2" type = "email" size = "30" name = "email2"/>
		<br/><br/>
		<input type = "submit">
		 </fieldset>
	</form>	
</html>
