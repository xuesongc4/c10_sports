<?php 
require('mysql_connect.php'); 
$username = $_POST['username'];

$check_query = "SELECT ID FROM users WHERE username = '{$username}'";
$result = mysqli_query($connection, $check_query);

$response = [];
$response['success'] = true;

if (!$check_query) {
	$response['success'] = false;
}
if(mysqli_num_rows($result)>0){
	$response['message'] = 'Username already taken';
} else {
	$response['message'] = '';
}

echo json_encode($response);
 ?>