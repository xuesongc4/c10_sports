<?php
session_start();
date_default_timezone_set('UTC');
require('constants.php');
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$user_id = $_SESSION['ID'];
$user_name = $_SESSION['username'];
//$user_id = 1;  //temp while no users are defined

$funds_query = "SELECT SUM(transaction) AS funds FROM `transactions` WHERE user_id = '$user_id'";
$funds_results = mysqli_query($connection, $funds_query);
$data = [];
if(mysqli_num_rows($funds_results)){
    while ($row = mysqli_fetch_assoc($funds_results)) {
        //round the funds data
        $data['funds'] = round($row['funds'], 2, PHP_ROUND_HALF_UP);
        $data['username'] = $user_name;
    }
}else{
    $data['errors'][] = 'user has no transactions';
}
//query to find the amount the user currently has at risk
$funds_at_risk_query = "SELECT SUM(amount) AS funds_at_risk FROM `bets` WHERE user_id = '$user_id' AND settled = 0";
$funds_at_risk_results = mysqli_query($connection, $funds_at_risk_query);
$otherInfo = [];    //temp
if(mysqli_num_rows($funds_at_risk_results)){
    while ($row = mysqli_fetch_assoc($funds_at_risk_results)) {
        if(round($row['funds_at_risk'], 2, PHP_ROUND_HALF_UP) > 0){
            $data['funds_at_risk'] = round($row['funds_at_risk'], 2, PHP_ROUND_HALF_UP);
        }else{
            $data['funds_at_risk'] = 0;
        }
    }
}else{
    $data['funds_at_risk'] = 0;
}

function calculate_win_total($bet_amount, $odds) {
    $win = null;
    if ($odds < 0) {
        $odds *= -1;
        $win = 100 / $odds * $bet_amount;
    } else {
        $win = $odds / 100 * $bet_amount;
    }
    $win = round($win, 2, PHP_ROUND_HALF_DOWN);
    return $bet_amount + $win;
}

$unsettled_bets_query = "SELECT amount, odds FROM `bets` WHERE user_id = '$user_id' AND settled = 0";
$unsettled_bets_results = mysqli_query($connection, $unsettled_bets_query);
$potential_returning_funds = 0;
if (mysqli_num_rows($unsettled_bets_results)) {
    while ($row = mysqli_fetch_assoc($unsettled_bets_results)) {
        $potential_returning_funds += calculate_win_total($row['amount'], $row['odds']);
    }
}

if ($potential_returning_funds) {
    $data['potential_returning_funds'] = $potential_returning_funds;
} else {
    $data['potential_returning_funds'] = 0;
}

//json encode the data
$json_encoded_object = json_encode($data);
//print the json encoded object
print($json_encoded_object);
?>