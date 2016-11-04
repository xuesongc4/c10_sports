<?php
require('find_users_funds.php');

///start herrrreeeee
$output = [
    ['sn' => 'dood1', 'money' =>1000],
    ['sn' => 'dood2','money' =>1200],
    ['sn' => 'dood3','money' =>15],
    ['sn' => 'gal1','money' =>250],
    ['sn' => 'gal2','money' =>1125],
    ['sn' => 'gal3','money' =>50],
];

$encoded_output = json_encode($output);
print($encoded_output);
?>


<!---->
<?php
//date_default_timezone_set('UTC');
//require('constants.php');
//$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//
//$user = 1;  //temp while no users are defined
//
//$funds_query = "SELECT SUM(transaction) AS funds FROM `transactions` WHERE user_id = '$user'";
//$funds_results = mysqli_query($connection, $funds_query);
//
//
//$data = [];
//if(mysqli_num_rows($funds_results)){
//    while ($row = mysqli_fetch_assoc($funds_results)) {
//        //round the funds data
//        $data['funds'] = round($row['funds'], 2, PHP_ROUND_HALF_UP);
//    }
//}else{
//    $data['errors'][] = 'user has no transactions';
//}
//
//print_r($data);
////print($data['funds']);
//?>