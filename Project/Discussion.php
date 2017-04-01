<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>360 Project</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/homepage.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/heightMatch.js"></script>
</head>
<body>
<?php 
	session_start();
	
	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		if(isset($_GET["discussionID"]))
		{
			$_SESSION['discussionID'] = $_GET['discussionID'];
		}
	}
	
	//already verify with javascript and know it's post, why do this?
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		header("Location: homepage.php");
	}
?>
<div id="container">
  <div id="banner">
   <?php	
	if(!isset($_SESSION['userID']))
		echo "<p id = \"loginLinks\"><a href=\"Login.php\">Login</a> | <a href=\"SignUp.php\">Sign Up</a></p>";
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
		<li><a href = "search.php">dog</a></li>
		<li><a href = "search.php">best</a></li>
		<li><a href = "search.php">good boy</a></li>
		<li><a href = "search.php">aw</a></li>
	</ul>
  </div>
  <div id="content">
    <h2>Introduction</h2>
    <p>Welcome to BestDog.com, the home of the best discussions about the best dog ever! Feel free to browse through the categories below and to the left, or search specific keywords to the right. 
	To track discussions and get more out of the experiance, feel free to sign up and become a member, thanks and enjoy your visit!</p>
    <hr noshade style = "border-width:0.10em">
	<table style="overflow:auto">
		<caption><h4>General Discussion</h4></caption>
		<tr>
			<th>Thread Title</th><th>Msgs</th><th>Last Post</th>
		</tr>
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
				$sql = "SELECT * FROM thread WHERE discussionID = ".$_SESSION['discussionID']."";

				$results = mysqli_query($connection, $sql);

				//and fetch results
				while ($row = mysqli_fetch_assoc($results))//search all users to see if there are already in database
				{
				  echo "<tr><td><a href=\"Thread.php?threadID=".$row['ID']."\">".$row['Title']."</a></td><td>".$row['NumMessages']."</td><td>".$row['LastUpdate']."</td></tr>";
				}
			}
		?>
	</table>
	<br><br>
	<button><a href = "newThread.php">Make Thread</a></button>
  </div>
  <div id="footer"><a href="homepage.php">Home</a> | <a href="contactUs.php">contact</a> | Site By: Ryan Kramer | copyright stuff | filler| footer stuff</div>
</div>
</body>
</php>
