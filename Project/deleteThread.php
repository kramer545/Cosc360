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
		if($_SESSION['userID'] != "1")
		{
			header("Location: homepage.php");
			die();
		}
		echo "<p id = \"loginLinks\">";
		if($_SESSION['userID'] == "1")
			echo "<a href=\"admin.php\">Admin</a> |";
		echo "<a href=\"Profile.php\">Profile</a> | <a href=\"SignOut.php\">Sign Out</a></p>";
	
	}
	
	$threadID;
	$post;
	
	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		if(isset($_GET["threadID"]))
		{
			$threadID = $_GET["threadID"];
			$post = $_GET["post"];
			
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
				$sql = "DELETE FROM message WHERE threadID=?";//have to delete all message first (thanks FK's)
				if($statement = mysqli_prepare($connection, $sql))
				{
					mysqli_stmt_bind_param($statement,'s',$threadID);
					mysqli_stmt_execute($statement);
				}
				
				$sql = "DELETE FROM thread WHERE ID=?";//delete thread itself
				if($statement = mysqli_prepare($connection, $sql))
				{
					mysqli_stmt_bind_param($statement,'s',$threadID);
					mysqli_stmt_execute($statement);
					
					echo "<form id = \"myForm\" action = \"search.php\" method = \"post\"><input type = \"hidden\" value = ".$post." id = \"search\" name = \"search\"></form>";
					echo " <script type=\"text/javascript\">var e = document.getElementById('myForm'); e.action='search.php'; e.submit();</script>";
				}
			}
		}
	}
	?>
	</table>
  </div>
</div>
</body>
</php>
