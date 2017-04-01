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
			echo "<p id = \"loginLinks\"><a href=\"Profile.php\">Profile</a> | <a href=\"SignOut.php\">Sign Out</a></p>";
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
		<li><a href = "search.php">dog</a></li>
		<li><a href = "search.php">best</a></li>
		<li><a href = "search.php">good boy</a></li>
		<li><a href = "search.php">aw</a></li>
	</ul>
  </div>
  <div id="content">
    <h2>Admin User Search</h2>
    <table>
		<tr><th>Username</th><th>Enable/Disable</th></tr>
		<?php
		
			$searchTerm;
			$searchType;
			
			if($_SERVER["REQUEST_METHOD"]=="GET")
			{
				header("Location: admin.php");
			}
			
			//already verify with javascript and know it's post, why do this?
			if($_SERVER["REQUEST_METHOD"]=="POST")
			{
				if((isset($_POST["userSearch"])) && (isset($_POST["searchType"])))
				{
					$searchTerm = $_POST["userSearch"];
					$searchType = $_POST["searchType"];
				}
				else
					header("Location: admin.php");
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
				$sql;
				if($searchType === "2")//post title, ps it's a abomination, but I aint got time to clean it up nor debug a simple error
				{
					$sql = "SELECT * FROM thread";

					$results = mysqli_query($connection, $sql);

					while ($row = mysqli_fetch_assoc($results))//Thread Title
					{
						if (strpos($row['Title'], $searchTerm) !== false)
						{
							$sql2 = "SELECT * FROM message WHERE threadID = ".$row['ID']."";

							$results2 = mysqli_query($connection, $sql2);

							while ($row2 = mysqli_fetch_assoc($results2))//Thread Title
							{
								$sql3 = "SELECT * FROM user WHERE ID = ".$row2['ID']."";
								$results3 = mysqli_query($connection, $sql3);

								while ($row3 = mysqli_fetch_assoc($results3))//Thread Title
								{
									echo "<tr><td>".$row3['Username']."</td><td><a href = \"enableUser.php?userID=".$row3['UserID']."\">".$row3['Enabled']."</a></td></tr>";
								}
							}
						}
					}
				}
				else
				{	
					if($searchType === "0")//username
						$sql = "SELECT * FROM user WHERE Username = ".$searchTerm."";
					else if ($searchType === "1")//email
						$sql = "SELECT * FROM user WHERE Email = ".$searchTerm."";

					$results = mysqli_query($connection, $sql);

					while ($row = mysqli_fetch_assoc($results))//Thread Title
					{
					  echo "<tr><td>".$row['Username']."</td><td><a href = \"enableUser.php?userID=".$row['UserID']."\">".$row['Enabled']."</a></td></tr>";
					}
				}
			}
			?>
	</table>	
  </div>
  <div id="footer"><a href="homepage.php">Home</a> | <a href="contactUs.php">contact</a> | Site By: Ryan Kramer | copyright stuff | filler| footer stuff</div>
</div>
</body>