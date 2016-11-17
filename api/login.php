<?php 
session_start();
require('mysql_connect.php'); 

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$username = stripslashes($username);
	$password = stripslashes($password);

	$username = mysqli_real_escape_string($connection, $username);
	$encrypted_password = sha1($password);

	$find_user_query = "SELECT ID FROM users WHERE username ='{$username}' AND password='{$encrypted_password}'";
	$find_user_result = mysqli_query($connection, $find_user_query);
	if (!$find_user_query) {
		die("QUERY FAIlED " . mysqli_error($connection));
	}
	if(mysqli_num_rows($find_user_result)>0){
		$row = mysqli_fetch_assoc($find_user_result);
		$_SESSION['ID'] = $row['ID'];
		$_SESSION['username'] = $username;
	}
	
	header('Location: ../');
}
 ?>