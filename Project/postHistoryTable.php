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
		header("location: homepage.php");
		die();
	}
	else
	{
		echo "<p id = \"loginLinks\">";
		if($_SESSION['userID'] == "1")
			echo "<a href=\"admin.php\">Admin</a> |";
		echo "<a href=\"Profile.php\">Profile</a> | <a href=\"SignOut.php\">Sign Out</a></p>";
	}
	?>
	<h1><a href = "homepage.php">www.BestDog.com</a></h1>
  </div>
  <hr noshade style = "border-width:0.15em">
  <!-- End Top Menu -->
  <div id="sidebar-a">
    <h2>Links</h2>
    <div class="menu">
      <ul>
        <li><a href="Discussion.php">General</a></li>
        <li><a href="Discussion.php">Announcements</a></li>
        <li><a href="Discussion.php">Popular Topics</a></li>
        <li><a href="aboutUs.php">About Us</a></li>
		<li><a href="contactUs.php">Contact Us</a></li>
      </ul>
    </div>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse a tortor. Pellentesque sollicitudin, ante nec posuere tempus, arcu lectus vehicula mi, ac rhoncus lorem turpis sed sapien. Pellentesque egestas.Pellentesque sollicitudin, ante nec posuere tempus, arcu lectus vehicula mi, ac rhoncus lorem turpis sed sapien. Pellentesque egestas. ac rhoncus lorem turpis sed sapien. Pellentesque egestas.ac rhoncus lorem turpis sed sapien</p>
  </div>
  <div id="sidebar-b">
    <h3>Forum Rules</h3>
    <ul>
		<li>Like Dogs</li>
		<li>Be Nice</li>
		<li>Don't be a prick</li>
		<li>There are no rules</li>
	</ul>
    <h3>Search</h3>
	<form id = "searchForm" method="post" action="search.php">
		<fieldset>
			<input id = "search" type="text" name="search" size="15" value = "search"/><input type="submit">
		</fieldset>
	</form>
	<h3>Most Searched</h3>
	<ul>
		<li><a href ="search.php">dog</a></li>
		<li><a href ="search.php">best</a></li>
		<li><a href ="search.php">good boy</a></li>
		<li><a href ="search.php">aw</a></li>
	</ul>
  </div>
  <div id="content">
    <h2>Search</h2>
    <hr noshade style = "border-width:0.10em">
	<div>
	<table>
		<tr><th>Topic</th><th>Message</th><th>Time Posted
		<?php 
	
			$searchTerm;
			if(isset($_SESSION['userID']))
			{
				if($_SESSION['userID']=== '1')//admin gets more options
					echo"</th><th>Edit</th><th>Delete";
			}
			echo"</th></tr>";
			
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
				$sql = "SELECT t.ID, t.Title, m.Post, m.CreateDate FROM thread t JOIN message m ON t.ID = m.ThreadID WHERE m.UserID = ".$_SESSION['userID'].""; //God this is sexy
				$results = mysqli_query($connection, $sql);

				//and fetch results
				while ($row = mysqli_fetch_assoc($results))
				{
						echo "<tr><td><a href=\"Thread.php?threadID=".$row['ID']."\">".$row['Title']."</a></td><td>".$row['Post']."</td><td>".$row['CreateDate']."</td>";
						if(isset($_SESSION['userID']))
						{
							if($_SESSION['userID'] === "1")
								echo "<td><a href=\"editThread.php?threadID=".$row['ID']."\">Edit</a></td><td><a href=\"deleteThread.php?threadID=".$row['ID']."\">Delete</a></td>";
						}
						echo "</tr>";
				}
				echo "</table>";
			}
	?>
	</div>
  </div>
 <div id="footer"><a href="homepage.php">Home</a> | <a href="contactUs.php">contact</a> | Site By: Ryan Kramer | copyright stuff | filler| footer stuff</div>
</div>
</body>
</html>
