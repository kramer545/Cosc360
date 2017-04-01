<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>360 Project</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/homepage.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/heightMatch.js"></script>
</head>
<body>
<div id="container">
  <div id="banner">
   <?php	
   session_start();
	if(!isset($_SESSION['userID']))
	{
		header("Location: homepage.php");
		die();
	}
	else
	{
		if($_SESSION['userID'] != 1)
		{
			header("Location: homepage.php");
			die();
		}
		else
		{
			echo "<p id = \"loginLinks\">";
			if($_SESSION['userID'] == "1")
				echo "<a href=\"admin.php\">Admin</a> |";
			echo "<a href=\"Profile.php\">Profile</a> | <a href=\"SignOut.php\">Sign Out</a></p>";
		}
	}
	
			$userID;
			
			if($_SERVER["REQUEST_METHOD"]=="GET")
			{
				if(isset($_GET["userID"]))
				{
					$userID = $_GET["userID"];
				}
				else
					header("Location: admin.php");
			}
			
			if($_SERVER["REQUEST_METHOD"]=="POST")
			{
				header("Location: admin.php");
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
				$sql = "SELECT * FROM user WHERE ID= ".$userID."";
				$sql2;

				$results = mysqli_query($connection, $sql);

				while ($row = mysqli_fetch_assoc($results))//Thread Title
				{
					 if($row['Enabled'] == 1)//true, enabled
						$sql2 = "UPDATE user SET Enabled = 0 WHERE ID = ".$row['ID']."";
					else
						$sql2 = "UPDATE user SET Enabled = 1 WHERE ID = ".$row['ID']."";	
					if($statement = mysqli_prepare($connection, $sql2))
					{
						mysqli_stmt_execute($statement);
						header("Location: admin.php");
						die();
					}
				}
			}
		?>