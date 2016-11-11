<?php
session_start();
require_once('mysql_connect.php');

//require('mysql_connect.php');
date_default_timezone_set('UTC');

//variables coming in
////static variables for testing
//$user_id = 2;
//$game_id = 193;

//
//$type_of_bet = 'spread';            //bet_type = 1
////$type_of_bet = 'moneyline';       //bet_type = 2
////$type_of_bet = 'over/under';      //bet_type = 3
//
//$side = true;
////$side = false;
//$line = 100;
//$odds = -107;
$bet_amount = 100;      //necessary when testing and not

//dynamic variables
$user_id = $_SESSION['ID'];
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
//$verify_result = mysqli_query($connection, $verify_query);
//if(mysqli_num_rows($verify_result)){
//    while($row = mysqli_fetch_assoc($verify_result)){
//        $data[] = $row;
//    }
//    $bet_query = "INSERT INTO `bets`(`user_id`, `amount`, `game_id`, `bet_type_id`, `side`, `line`, `odds`) VALUES ('$user_id', '$bet_amount', '$game_id', '$bet_type', '$side', '$line', '$odds')";
//    $bet_result = mysqli_query($connection, $bet_query);
//    //verification that bet writing worked
//    print_r(mysqli_affected_rows($connection));
//}else{
//    $data['error'][] = "data has been updated. Try again later";
//    $encoded_data = json_encode($data);
//    print($data);
//}
//$curr_time = time();
//$curr_time = date('Y-m-d H:i:s', $curr_time);
$curr_time = date('Y-m-d H:i:s', time());

//idea to limit the adding of bets to in progress and completed games:
//add select query prior to writing insert
//compare formatted current to start time of game
//if the game is after the start time bet should fail and we should return an error

//should create empty array for data variable
$data = [];


$game_time_query = "SELECT game_time FROM `games` WHERE ID = '$game_id'";
$game_time_results = mysqli_query($connection, $game_time_query);

if(mysqli_num_rows($game_time_results)){
    while($row = mysqli_fetch_assoc($game_time_results)) {
        $game_time = $row['game_time'];
    }
}

if($curr_time < $game_time){
    //game can still be bet on
    $insert_bet_query = "INSERT INTO `bets`(`user_id`, `amount`, `game_id`, `bet_type_id`, `side`, `line`, `odds`, `time_placed`) VALUES ('$user_id', '$bet_amount', '$game_id', '$type_of_bet', '$side', '$line', '$odds', '$curr_time')";
    $insert_bet_result = mysqli_query($connection, $insert_bet_query);

    $transaction = $bet_amount * -1;
    if(mysqli_affected_rows($connection)){
        $transaction_query = "INSERT INTO `transactions`(`user_id`, `transaction`, `time`) VALUES ('$user_id', '$transaction', '$curr_time')";
        $transaction_results = mysqli_query($connection, $transaction_query);

        //verification that bet writing and transaction worked
        if(mysqli_affected_rows($connection)){
            $data['success'] = true;

            $bet_query_select_clause = "SELECT bt.bet_name, COUNT(b.ID) AS bet_qty ";
            $bet_query_from_clause = "FROM `bets` AS b ";
            $bet_query_join_clause = "JOIN `bet_types` AS bt ON b.bet_type_id = bt.ID ";
            $bet_query_where_clause = "WHERE b.game_id = '$game_id' AND b.user_id = '$user_id' ";
            $bet_query_group_clause = "GROUP BY bt.bet_name ";
            //concatenate query clauses together
            $bet_query = $bet_query_select_clause . $bet_query_from_clause . $bet_query_join_clause . $bet_query_where_clause . $bet_query_group_clause;
            $bet_results = mysqli_query($connection, $bet_query);
            if(mysqli_num_rows($bet_results)){
                //if there are any results see if there are any of the appropriate keys in the result
                $data['bets_placed'] = [
                    'spread'=>0,
                    'moneyline'=>0,
                    'over/under'=>0
                ];
                while($row = mysqli_fetch_assoc($bet_results)){
                    $data['bets_placed'][$row['bet_name']] = $row['bet_qty'];
                }
            }
            //convert values to true or false
            if($data['bets_placed']['spread'] > 0){
                $data['bets_placed']['spread'] = 'true';
            }else{
                $data['bets_placed']['spread'] = 'false';
            }
            if($data['bets_placed']['moneyline'] > 0){
                $data['bets_placed']['moneyline'] = 'true';
            }else{
                $data['bets_placed']['moneyline'] = 'false';
            }
            if($data['bets_placed']['over/under'] > 0){
                $data['bets_placed']['over/under'] = 'true';
            }else{
                $data['bets_placed']['over/under'] = 'false';
            }
        }else{
            //insert transaction query did not go through
            $data['success'] = false;
            $data['errors'][] = 'transaction failed';
        }
    }else{
        //insert bet query did not go through
        $data['success'] = false;
        $data['errors'][] = 'bet failed';
    }
}else{
    //game can't be bet on due to being to late
    $data['success'] = false;
    $data['errors'][] = 'it is too late to place this bet';
}

$data = json_encode($data);
print($data);
?>