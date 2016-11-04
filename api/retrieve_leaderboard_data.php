<?php
date_default_timezone_set('UTC');
require('constants.php');
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//$user = 1;  //temp while no users are defined

//currently username is saved as 'sn' to accomodate Jason's angular naming conventions
$leaderboard_query = "SELECT u.username AS sn, ROUND(SUM(t.transaction),2) AS money FROM `transactions` AS t JOIN `users` AS u ON u.ID = t.user_id GROUP BY t.user_id ORDER BY money DESC LIMIT 10";
$leaderboard_results = mysqli_query($connection, $leaderboard_query);


$data = [];
if(mysqli_num_rows($leaderboard_results)){
    while ($row = mysqli_fetch_assoc($leaderboard_results)) {
        $data[] = $row;
    }
}else{
    $data['errors'][] = 'no leaderboard data available';
}

$encoded_output = json_encode($data);
print($encoded_output);

//***************** old ***********************
//
//$output = [
//    ['sn' => 'dood1', 'money' =>1000],
//    ['sn' => 'dood2','money' =>1200],
//    ['sn' => 'dood3','money' =>15],
//    ['sn' => 'gal1','money' =>250],
//    ['sn' => 'gal2','money' =>1125],
//    ['sn' => 'gal3','money' =>50],
//];
//
//$encoded_output = json_encode($output);
//print($encoded_output);
?>