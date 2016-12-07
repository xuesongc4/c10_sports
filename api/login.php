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
		$_SESSION['message'] = '';
	} else {
		$_SESSION['message'] = 'Incorrect username or password';
	}
	
	header('Location: ../');
}

if (isset($_POST['guest'])){
  $username = mysqli_real_escape_string($connection, 'guest');
  $encrypted_password = sha1('guest');

  $find_user_query = "SELECT ID FROM users WHERE username ='{$username}' AND password='{$encrypted_password}'";
  $find_user_result = mysqli_query($connection, $find_user_query);
  if (!$find_user_result) {
      die("QUERY FAIlED " . mysqli_error($connection));
  }
  if(mysqli_num_rows($find_user_result)>0){
      $row = mysqli_fetch_assoc($find_user_result);
      $_SESSION['ID'] = $row['ID'];
      $_SESSION['username'] = $username;
  }

  header('Location: ../');
}

if (isset($_POST['signup'])) {
	$username = $_POST['username_signup'];
	$email = $_POST['email_signup'];
	$password = sha1($_POST['password_signup']);
	$create_user_query = "INSERT INTO users (username, email, password) VALUES ('{$username}', '{$email}', '{$password}')";
	$create_user_result = mysqli_query($connection, $create_user_query);
	if (!$create_user_result) {
        die("QUERY FAIlED " . mysqli_error($connection));
    }
    $user_id_query = "SELECT ID FROM `users` WHERE `username` = '{$username}'";
    $user_id_result = mysqli_query($connection, $user_id_query);
    if(mysqli_num_rows($user_id_result)){
        while ($row = mysqli_fetch_assoc($user_id_result)){
            $user_id = $row['ID'];
        }
        $first_transaction_query = "INSERT INTO `transactions` (`user_id`, `transaction`, `time`) VALUES ({$user_id}, '0', NOW());";
        $first_transaction_result = mysqli_query($connection, $first_transaction_query);

    }
    $_SESSION['message'] = "User created!";

    header('Location: ../');
}
 ?>