<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

		<?php
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
				$sql = "SELECT * FROM discussion";
				
				echo "<tr><th>Board</th><th>Topics</th><th>Last Post</th></tr>";

				$results = mysqli_query($connection, $sql);

				//and fetch results
				while ($row = mysqli_fetch_assoc($results))//search all users to see if there are already in database
				{
				  echo "<tr><td><a href=\"Discussion.php?discussionID=".$row['ID']."\">".$row['Title']."</a></td><td>".$row['NumThreads']."</td><td>".$row['LastUpdate']."</td></tr>";
				}
			}
		?>
</html>
