<!DOCTYPE html>
<html>

<p>Here are some results:</p>

<?php
	session_start();

	
	$username;
	$userPassword;
	$email;
	$target_file;
	$imageFileType;
	$uploadOk = 1;
	$target_dir = "images/";
	
	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		echo "get method";
		header("Location: login.php");
	}
	
	//already verify with javascript and know it's post, why do this?
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if((isset($_POST["username"])) && (isset($_POST["email"])) && (isset($_POST["password"])))
		{
			$username = $_POST["username"];
			$userPassword = $_POST["password"];
			$email = $_POST["email"];
			
				$target_file = $target_dir . basename($_FILES["profilePic"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = getimagesize($_FILES["profilePic"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} 
				else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" ) {
					echo "Sorry, only JPG, PNG & GIF files are allowed.";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file)) {
						echo "The file ". basename( $_FILES["profilePic"]["name"]). " has been uploaded.";
					} else {
						echo "Sorry, there was an error uploading your file.";
					}
				}
			
		}
		else //DO SOMETHING HERE
		{
			echo "some value not found";
		}
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
		$imagedata = file_get_contents($_FILES["profilePic"]["tmp_name"]);
		//store the contents of the files in memory in preparation for upload
		$sql = "INSERT INTO user (Username, Email,Password,ImageType,Image) VALUES (?,?,?,?,?)";
		 // create a new statement to insert the image into the table. Recall
		// that the ? is a placeholder to variable data.
		$stmt = mysqli_stmt_init($connection); //init prepared statement object

		mysqli_stmt_prepare($stmt, $sql); // register the query

		$null = $imagedata;
		mysqli_stmt_bind_param($stmt, "ssssb", $username,$email,$userPassword, $imageFileType, $null);
		// bind the variable data into the prepared statement. You could replace
		// $null with $data here and it also works. You can review the details
		// of this function on php.net. The second argument defines the type of
		// data being bound followed by the variable list. In the case of the
		// blob, you cannot bind it directly so NULL is used as a placeholder.
		// Notice that the parametner $imageFileType (which you created previously)
		// is also stored in the table. This is important as the file type is
		// needed when the file is retrieved from the database.

		mysqli_stmt_send_long_data($stmt, 2, $imagedata);
		// This sends the binary data to the third variable location in the
		// prepared statement (starting from 0).
		$result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
		// run the statement

		mysqli_stmt_close($stmt); // and dispose of the statement. 
		
		//header("Location: homepage.php");
		//die();
}
?>
</html>
