<?php
session_start();
date_default_timezone_set('UTC');
require('constants.php');
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$user_id = $_SESSION['ID'];
//$user_id = 1;  //temp while no users are defined

$funds_query = "SELECT SUM(transaction) AS funds FROM `transactions` WHERE user_id = '$user_id'";
$funds_results = mysqli_query($connection, $funds_query);
$data = [];
if(mysqli_num_rows($funds_results)){
    while ($row = mysqli_fetch_assoc($funds_results)) {
        //round the funds data
        $data['funds'] = round($row['funds'], 2, PHP_ROUND_HALF_UP);
    }
}else{
    $data['errors'][] = 'user has no transactions';
}
print_r($data);
?>