<?php
date_default_timezone_set('UTC');
require('constants.php');
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$user = 1;  //temp while no users are defined

$funds_query = "SELECT SUM(transaction) AS funds FROM `transactions` WHERE user_id = '$user'";
$funds_results = mysqli_query($connection, $funds_query);


$data = [];
if(mysqli_num_rows($funds_results)){
    while ($row = mysqli_fetch_assoc($funds_results)) {
        $data['funds'] = $row['funds'];
    }
}else{
    $data['errors'][] = 'user has no transactions';
}

print_r($data);
//print($data['funds']);
?>