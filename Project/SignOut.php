<!DOCTYPE html>
<html>

<p>Here are some results:</p>

<?php
	session_start();
	unset($_SESSION['userID']);
	header("Location: homepage.php");
	die();
?>
</html>
