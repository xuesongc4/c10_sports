<?php
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 10/26/2016
 * Time: 12:14 PM
 */

require_once('mysql_connect.php');
date_default_timezone_set('UTC');

//variables coming in
//static variables for now
$user_id = 1;
//$game_number = 4;
$bet_amount = 100;

//$type_of_bet = 'spread';            //bet_type = 1
//$type_of_bet = 'moneyline';       //bet_type = 2
//$type_of_bet = 'over/under';      //bet_type = 3

//$first_side = true;
//$first_side = false;

//dynamic variables
$game_id = $_POST['game_id'];
$line = $_POST['line'];
$odds = $_POST['odds'];
$side = $_POST['side'];
$type_of_bet = $_POST['type_of_bet'];


////very temporary
//$type_of_bet = 1;


////variables to be stored for next query
//$bet_type; //either 1 for spread, 2 for moneyline, 3 for over/under
//$side;  //either 1 for true or 0 for false
//$line;  //only necessary for bet_type 1 and 3
//$odds;  //dependent on bet_type and first_side


////only use when verifying data ahead of time
if($type_of_bet === 1){
    $lookup_line = "home_spread";
    if($side){
        $lookup_odds = "spread_odds_h";
    }else{
        $lookup_odds = "spread_odds_a";
    }
}else if($type_of_bet === 2){
    $lookup_line = null;
    if($side){
        $lookup_odds = "moneyline_odds_h";
    }else{
        $lookup_odds = "moneyline_odds_a";
    }
}else{
    $lookup_line = "overunder_points";
    if($side){
        $lookup_odds = "overunder_odds_o";
        $side = 1;
    }else{
        $lookup_odds = "overunder_odds_u";
        $side = 0;
    }
}
////only use when verifying data ahead of time
//if($type_of_bet !== 'moneyline'){
//    $verify_query = "SELECT '$lookup_line', '$lookup_odds' FROM `games` WHERE ID = '$game_id'";
//}else{
//    $verify_query = "SELECT '$lookup_odds' FROM `games` WHERE ID = '$game_id'";
//}
//$data = [];
//$verify_result = mysqli_query($conn, $verify_query);
//if(mysqli_num_rows($verify_result)){
//    while($row = mysqli_fetch_assoc($verify_result)){
//        $data[] = $row;
//    }
//    $bet_query = "INSERT INTO `bets`(`user_id`, `amount`, `game_id`, `bet_type_id`, `side`, `line`, `odds`) VALUES ('$user_id', '$bet_amount', '$game_id', '$bet_type', '$side', '$line', '$odds')";
//    $bet_result = mysqli_query($conn, $bet_query);
//    //verification that bet writing worked
//    print_r(mysqli_affected_rows($conn));
//}else{
//    $data['error'][] = "data has been updated. Try again later";
//    $encoded_data = json_encode($data);
//    print($data);
//}

$insert_bet_query = "INSERT INTO `bets`(`user_id`, `amount`, `game_id`, `bet_type_id`, `side`, `line`, `odds`) VALUES ('$user_id', '$bet_amount', '$game_id', '$type_of_bet', '$side', '$line', '$odds')";
$insert_bet_result = mysqli_query($conn, $insert_bet_query);

//verification that bet writing worked
$data = [];
if(mysqli_affected_rows($conn)){
    $data['success'] = true;
    $data['bet_placed'] = $type_of_bet;
}else{
    $data['success'] = false;
}
$data = json_encode($data);
print($data);
?>