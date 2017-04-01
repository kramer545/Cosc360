<!DOCTYPE html>
<html>

<p>Here are some results:</p>

<?php
	session_start();

	$userID;
	$text;
	$username;
	$discussionID;
	$threadID;
	$title;
	
	
	
	if(isset($_SESSION['userID']))//already logged in
	{
		$userID = $_SESSION['userID'];
	}
	else
	{
		$userID = 2;//not logged in, anon account
	}
	
	if(isset($_SESSION['discussionID']))
	{
		$discussionID = $_SESSION['discussionID'];
	}
	else
	{
		$discussionID = 1;//default
	}
	
	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		echo "get method";
		header("Location: homepage.php");
	}
	
	//already verify with javascript and know it's post, why do this?
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if((isset($_POST["post"])) && (isset($_POST["title"])))
		{
			echo "both values here";
			$text = $_POST["post"];
			$title = $_POST["title"];
		}
		else //DO SOMETHING HERE
		{
			echo "post or threadID not found";
		}
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
	
	if($userID != 2)
	{
			//good connection, so do your thing
		$sql = "SELECT * FROM users WHERE ID = ".$userID.";";

		$results = mysqli_query($connection, $sql);

		//and fetch results
		while ($row = mysqli_fetch_assoc($results))//search all users to see if there are already in database
		{
		  $username = $row['Username'];
		}
	}
	else
		$username = "Anonymous";
	
	$sql = "INSERT INTO thread(DiscussionID, Title) VALUES (?,?)";
	if($statement = mysqli_prepare($connection, $sql))
	{
		mysqli_stmt_bind_param($statement,'ss',$discussionID,$title);
		mysqli_stmt_execute($statement);
		$threadID = mysqli_insert_id($connection);//get autoincremented id
		echo " ".$threadID."";
		//Do new message and attach it to thread
		$sql = "INSERT INTO message (ThreadID, UserID,Post,Username) VALUES (?,?,?,?)";
		if($statement = mysqli_prepare($connection, $sql))
		{
			mysqli_stmt_bind_param($statement,'ssss',$threadID,$userID,$text,$username);
			mysqli_stmt_execute($statement);
			
			$sql = "UPDATE discussion SET NumThreads = NumThreads+1 WHERE ID=?";
			if($statement = mysqli_prepare($connection, $sql))
			{
				mysqli_stmt_bind_param($statement,'s',$discussionID);
				mysqli_stmt_execute($statement);
				header("Location: thread.php?threadID=".$threadID."");
			}
		}
	}
}
?>
</html>
