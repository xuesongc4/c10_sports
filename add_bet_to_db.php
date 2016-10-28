<?php
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 10/26/2016
 * Time: 12:14 PM
 */

date_default_timezone_set('America/New_York');
require_once('mysql_connect.php');


//variables coming in
$bet_type = 'spread';
//$bet_type = 'moneyline';
//$bet_type = 'over/under';

$first_side = true;
//$first_side = false;

//variables to be stored for next query
$bet_type; //either 1 for spread, 2 for moneyline, 3 for over/under
$side;  //either 1 for true or 0 for false
$line;  //only necessary for bet_type 1 and 3
$odds;  //dependent on bet_type and first_side


if($bet_type === 'spread'){
    $bet_type = 1;
    $line = 'home_spread';
    if($first_side){
        $odds = 'spread_odds_a';
        $side = 1;
    }else{
        $odds = 'spread_odds_h';
        $side = 2;
    }
}else if($bet_type === 'moneyline'){
    $bet_type = 2;
    if($first_side){
        $odds = 'moneyline_odds_a';
        $side = 1;
    }else{
        $odds = 'moneyline_odds_h';
        $side = 2;
    }
}else{
    $bet_type = 3;
    if($first_side){
        $odds = 'overunder_odds_o';
        $side = 1;
    }else{
        $odds = 'overunder_odds_u';
        $side = 2;
    }
}


$game_number = 3;

//$game_query = "SELECT * FROM `games` WHERE ID = " + "'" + $game_number + "'";


//////////test further the string params arent being input properly


//will need to set up separate extra if to separate out the times when bet_type = moneyline
$game_query = "SELECT '$bet_type', '$side', '$odds' FROM `games` WHERE ID = '$game_number'";
//$game_query = "SELECT home_spread FROM `games` WHERE ID = '$game_number'";

$game_result = mysqli_query($conn, $game_query);

$games = [];

//$bet_query1 = "INSERT INTO `bets`(`user_id`, `amount`, `bet_type_id`, `game_id`, `side`, `line`, `odds`) VALUES ('1', '100', '1', '3', '1', '-7.5', '-101')";
//$bet_query2 = "INSERT INTO `bets`(`user_id`, `amount`, `bet_type_id`, `game_id`, `side`, `line`, `odds`) VALUES ('2', '100', '1', '3', '0', '-7.5', '-109')";




if(mysqli_num_rows($game_result)) {
    while($row = mysqli_fetch_assoc($game_result)){
        $games[] = $row;
    }
    print_r($games);
}


//if(mysqli_num_rows($game_result)) {
//    print_r($game_result);
//}


//$bet_search = mysqli_query($conn, $bet_query1);

//$bet_result = mysqli_query($conn, $bet_query1);
//if(mysqli_num_rows($bet_result)){
//    print('<br>w')
//}

?>