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
    <h2>Admin Features</h2>
    <p>Admin functionality listed below, if you aren't a admin, go away</p>
    <hr noshade style = "border-width:0.10em">
	<h4>Search Users</h4>
	<br>
	<p>By Username: 
		<form id = "searchUsername" method="post" action="searchUser.php">
			<fieldset>
				<input id = "userSearch" type="text" name="userSearch" size="30"/>
				<input type="hidden" value="0" name="searchType" id = "searchType" />
				<input type="submit"/>
			</fieldset>
		</form>
	</p>
	<br>
	<p>By Email: 
		<form id = "searchEmail" method="post" action="searchUser.php">
			<fieldset>
				<input id = "userSearch" type="text" name="userSearch" size="30"/>
				<input type="hidden" value="1" name="searchType" id = "searchType" />
				<input type="submit"/>
			</fieldset>
		</form>
	</p>
	<br>
	<p>By Post Title(all users who posted in topic): <!--is this what is meant by search users by topic post? -->
		<form id = "searchPost" method="post" action="searchUser.php">
			<fieldset>
				<input id = "userSearch" type="text" name="userSearch" size="30"/>
				<input type="hidden" value="2" name="searchType" id = "searchType" />
				<input type="submit"/>
			</fieldset>
		</form>
	</p>
	<br>
	<p>Use search feature on right sidebar to browse and edit posts, or just find the post and edit it there</p>
  </div>
  <div id="footer"><a href="homepage.php">Home</a> | <a href="contactUs.php">contact</a> | Site By: Ryan Kramer | copyright stuff | filler| footer stuff</div>
</div>
</body>