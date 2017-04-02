<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>360 Project</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php 
	session_start();
		
			$host = "cosc360.ok.ubc.ca";
			$database = "db_24604143";
			$user = "24604143";
			$password = "24604143"; 
			
			echo "<tr><th>User</th><th>Message</th><th>Post Date</th></tr>";
			
			$connection = mysqli_connect($host, $user, $password, $database);

			$error = mysqli_connect_error();
			if($error != null)
			{
			  $output = "<p>Unable to connect to database!</p>";
			  exit($output);
			}
			else
			{
				$sql = "SELECT * FROM thread WHERE ID = ".$_SESSION['threadID']."";

				$results = mysqli_query($connection, $sql);

				while ($row = mysqli_fetch_assoc($results))//Thread Title
				{
				  echo "<caption><h4>".$row['Title']."</h4></caption>";
				}
				
				$sql = "SELECT * FROM message WHERE ThreadID = ".$_SESSION['threadID']."";

				$results = mysqli_query($connection, $sql);

				//and fetch results
				while ($row = mysqli_fetch_assoc($results))//search all users to see if there are already in database
				{
				  echo "<tr><td>".$row['Username']."</td><td>".$row['Post']."</td><td>".$row['CreateDate']."</td></tr>";
				}
			}
		?>
</php>
