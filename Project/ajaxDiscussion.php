<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php
			session_start();
			
			$host = "cosc360.ok.ubc.ca";
			$database = "db_24604143";
			$user = "24604143";
			$password = "24604143"; 
			
			$connection = mysqli_connect($host, $user, $password, $database);

			$error = mysqli_connect_error();
			if($error != null)
			{
			  $output = "<p>Unable to connect to database!</p>";
			  echo $output;
			  exit($output);
			}
			else
			{
				$sql = "SELECT * FROM thread WHERE discussionID = ".$_SESSION['discussionID']."";

				$results = mysqli_query($connection, $sql);
				$title = "1";
				//and fetch results
				while ($row = mysqli_fetch_assoc($results))//search all users to see if there are already in database
				{
				 if($title === "1")//only want to echo title once
				 {
					 $sql2 = "SELECT * FROM discussion WHERE ID = ".$_SESSION['discussionID']."";

					$results2 = mysqli_query($connection, $sql2);
					$title = "1";
					//and fetch results
					while ($row2 = mysqli_fetch_assoc($results2))//search all users to see if there are already in database
					{
						 echo "<caption><h4>".$row2['Title']."</h4></caption><tr><th>Thread Title</th><th>Msgs</th><th>Last Post</th></tr>";
					}
				 }
				 $title = "2";
				  echo "<tr><td><a href=\"Thread.php?threadID=".$row['ID']."\">".$row['Title']."</a></td><td>".$row['NumMessages']."</td><td>".$row['LastUpdate']."</td>";
						if(isset($_SESSION['userID']))
						{
							if($_SESSION['userID'] === "1")
								echo "<td><a href=\"editThread.php?threadID=".$row['ID']."\">Edit</a></td><td><a href=\"deleteThread.php?threadID=".$row['ID']."&post=".$searchTerm."\">Delete</a></td>";
						}
						echo "</tr>";
				}
			}
		?>
</html>
