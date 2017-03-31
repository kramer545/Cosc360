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
		echo "<p id = \"loginLinks\"><a href=\"Profile.php\">Profile</a> | <a href=\"SignOut.php\">Sign Out</a></p>";
	}
	
	$messageID;
	$post;
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if((isset($_POST["messageID"]) && isset($_POST["post"])))
		{
			$messageID = $_POST["messageID"];
			$post = $_POST["post"];
			
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
				$sql = "UPDATE message SET Post = ? WHERE ID = ?";
				if($statement = mysqli_prepare($connection, $sql))
				{
					mysqli_stmt_bind_param($statement,'ss',$post,$messageID);
					mysqli_stmt_execute($statement);
					header("Location: editMessage.php?messageID=".$messageID);
					die();
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
