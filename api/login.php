<?php 
session_start();
require('mysql_connect.php'); 

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$username = stripslashes($username);
	$password = stripslashes($password);

	$username = mysqli_real_escape_string($connection, $username);
	$password = mysqli_real_escape_string($connection, $password);

	$find_user_query = "SELECT * FROM users WHERE username ='{$username}'";
	$find_user_result = mysqli_query($connection, $find_user_query);
	if (!$find_user_query) {
		die("QUERY FAIlED " . mysqli_error($connection));
	}

	while ($row = mysqli_fetch_assoc($find_user_result)) {
		$db_id = $row['ID'];
		$db_username = $row['username'];
		$db_password = $row['password'];
	}

	if ($username === $db_username && $password === $db_password) {
		$_SESSION['ID'] = $db_id;
		$_SESSION['username'] = $db_username;
	}
	header('Location: ../index.php');
}
 ?>