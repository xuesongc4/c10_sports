<?php
//require_once('mysql_connect.php');      //necessary when testing it on its own
date_default_timezone_set('UTC');
//make function to format the incoming bet

//in order to be effective i need an input of game_id to cut down on the games to look at
// the file db_query has a portion that checks if games are completed, after this point it should call this file to
//check_for_wins_on_settled_games(140);       //necessary when testing it on its own

function check_for_wins_on_settled_games($game_id)
{
//    global $conn;                       //necessary when testing it on its own
    global $connection;
    //make query to db to see unresolved bets
    $temp_bets_query = "SELECT b.ID, b.user_id, b.amount, bt.bet_name AS bet_type, b.side, b.line, b.odds, g.final_score_a, g.final_score_h FROM `bets` AS b JOIN `games` AS g ON g.ID = b.game_id JOIN `bet_types` AS bt ON bt.ID = b.bet_type_id WHERE settled = '0' AND game_id = '$game_id'";
//    $result = mysqli_query($conn, $temp_bets_query);                    //necessary when testing it on its own
    $result = mysqli_query($connection, $temp_bets_query);

    $data = [];
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = check_for_a_win($row['final_score_a'], $row['final_score_h'], $row['amount'], $row['bet_type'], $row['side'], $row['odds'], $row['line']);
        }
    }
//    print_r($data);       //working for when the page is all by itself
    return $data;
}

//will return the amount of money won on the bet
//final score rendered as an array with first score representing away score and second the home team's score
//bet_first_side is a boolean value to determine if the player bet the first option in the bet type (i.e. bet away team in spread or money line and over in an over/under bet
function check_for_a_win($final_score_a, $final_score_h, $wager, $bet_type, $bet_side, $odds, $line){
    $win_amount = null;

    if ($bet_type === 'spread') {       //bet is on the spread
        $win_amount = check_spread_win($bet_side, $wager, $odds, $line, $final_score_a, $final_score_h);
    } else if ($bet_type === 'moneyline') {       //bet is on moneyline
        $win_amount = check_money_line_win($bet_side, $wager, $odds, $final_score_a, $final_score_h);
    } else {          //else bet is on over/under
        $win_amount = check_over_under_win($bet_side, $wager, $odds, $line, $final_score_a, $final_score_h);
    }
//    console . log('win_amount: ', $win_amount);
//    print("win amount: " + $win_amount + "<br><br>");
    return $win_amount;
}

/* to check spread:
1) always add line to the home side in final score
2) find out what side we bet on
3) compare appended final scores. side we bet on must be strictly greater than other side*/
function check_spread_win($bet_home, $wager, $odds, $line, $final_score_a, $final_score_h){
    $win_amount = null;
    $final_score_h += $line;
    if ($bet_home) {  //bet is for home team
        if ($final_score_a < $final_score_h) {
            $win_amount = calculate_win_total($wager, $odds);
        } else if ($final_score_a > $final_score_h) {
            $win_amount = 0;
        } else {
            $win_amount = $wager;
        }
    } else {      //bet is for away team
        if ($final_score_a > $final_score_h) {
            $win_amount = calculate_win_total($wager, $odds);
        } else if ($final_score_a < $final_score_h) {
            $win_amount = 0;
        } else {
            $win_amount = $wager;
        }
    }
    return $win_amount;
}

/* to check the spread simply compare the final score
* if the bet is for the away team and the away team won, then calculate win, if they lose user loses and gains no money, if the teams tie then it is a push and the user gets the wager amount back
* if the bet is for the home team and the away team won, then calculate win, if they lose user loses and gains no money, if the teams tie then it is a push and the user gets the wager amount back*/
function check_money_line_win($bet_home, $wager, $odds, $final_score_a, $final_score_h){
    $win_amount = null;
    if ($bet_home) {
        if ($final_score_a < $final_score_h) {        //home team wins
            $win_amount = calculate_win_total($wager, $odds);
        } else if ($final_score_a > $final_score_h) {  //away team wins
            $win_amount = 0;
        } else {                                      //tie
            $win_amount = $wager;
        }
    } else {
        if ($final_score_a > $final_score_h) {        //away team wins
            $win_amount = calculate_win_total($wager, $odds);
        } else if ($final_score_a < $final_score_h) {  //home team wins
            $win_amount = 0;
        } else {                                      //tie
            $win_amount = $wager;
        }
    }
    return $win_amount;
}
//checks for the win conditions of over/under bets
function check_over_under_win($bet_under , $wager, $odds, $line, $final_score_a, $final_score_h){
    $total_score = $final_score_a + $final_score_h;
    if ($total_score > $line) { //only bets for the over win, other bets will return no money
        if (!$bet_under) { //bet for over is true when not betting on the under
            $win_amount = calculate_win_total($wager, $odds);
        } else {
            $win_amount = 0;
        }
    } else if ($total_score < $line) { //only bets for the under win, other bets will return no money
        if ($bet_under) {
            $win_amount = calculate_win_total($wager, $odds);
        } else {
            $win_amount = 0;
        }
    } else {  //a push occurs and you get your money back, one is unable to place a bet on a tie (i believe, at least in this type of bet)
        $win_amount = $wager;
    }
    return $win_amount;
}
//calculates the total amount returned from a won bet
//example: odds of -350 mean that you would have to bet 350 in order to win 100, and odds of +350 would mean you could bet 100 to win 350.
function calculate_win_total($bet_amount, $odds) {
    $win = null;
    if ($odds < 0) {
        $odds *= -1;
        $win = 100 / $odds * $bet_amount;
    } else {
        $win = $odds / 100 * $bet_amount;
    }
    $win = round_down($win);
    return $bet_amount + $win;
}
//function to round down to the nearest hundredth
function round_down($number){
    $number *= 100;
    $number = floor($number);
    $number /= 100;
    return $number;
}