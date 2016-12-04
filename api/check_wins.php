<?php
require_once('mysql_connect.php');      //necessary when testing it on its own
date_default_timezone_set('UTC');

//call of function that will check all old games for accuracy
//correct_wins_on_past_games($connection);

//in order to be effective i need an input of game_id to cut down on the games to look at
// the file db_query has a portion that checks if games are completed, after this point it should call this file to

//check_for_wins_on_settled_games(140);       //necessary when testing it on its own  (old for when using our game ID)
//check_for_wins_on_settled_games(654458760);       //necessary when testing it on its own  (new for when using their game ID)

//for testing purposes of the method to correct old, bad bet results
//print('<pre>');
//print_r(correct_wins_on_past_games($connection));
//print('</pre>');

function check_for_wins_on_settled_games($connection, $API_game_id)
{
//    global $connection;       //necessary when testing it on its own
    // $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    //make query to db to see unresolved bets
    $bets_query = "SELECT b.ID, b.user_id, b.amount, b.bet_type_id AS bet_type, b.side, b.line, b.odds, g.final_score_a, g.final_score_h FROM `bets` AS b JOIN `games` AS g ON g.ID = b.game_id JOIN `bet_types` AS bt ON bt.ID = b.bet_type_id WHERE b.settled = '0' AND g.API_game_id = '$API_game_id'";
    $bets_result = mysqli_query($connection, $bets_query);

    $bets_data = [];
    if (mysqli_num_rows($bets_result)) {
        while ($row = mysqli_fetch_assoc($bets_result)) {
            //create temp array
            $temp_arr = [];
            //store the bet id
            $temp_arr['bet_id'] = $row['ID'];
            //store user_id associated with the bet placed
            $temp_arr['user_id'] = $row['user_id'];
            //store wager associated with the bet placed
            $temp_arr['wager'] = $row['amount'];
            //calculate the win amount for the specific bet and store in temp array
            $temp_arr['win_amount'] = check_for_a_win($row['final_score_a'], $row['final_score_h'], $row['amount'], $row['bet_type'], $row['side'], $row['odds'], $row['line']);
            //push the temp array to the data array
            $bets_data[] = $temp_arr;
        }
    }
    //create a query to settle each bet in the bets table
    $bet_transactions = [];
    foreach($bets_data as $bet){
        $temp_arr = [];
        if($bet['win_amount'] > 0){
            //if the win_amount is greater than 0 a transaction is required to show the user won money. So we need to write a transaction query
            $transaction_query = "INSERT INTO `transactions`(`user_id`, `transaction`, `time`) VALUES ('$bet[user_id]', '$bet[win_amount]', NOW())";
            $transaction_result = mysqli_query($connection, $transaction_query);
            //if transaction was written, update the bets table to reflect that the
            if(mysqli_affected_rows($connection)){
                if($bet['win_amount'] === $bet['wager']) {
                    //win amount is the same as the wager, so there is a tie/push (settled value 2)
                    $update_bets_query = "UPDATE `bets` SET `settled`= '2' WHERE ID = '$bet[bet_id]'";
                }else {
                    //win_amount is above 0, and will be above the wager, and hence a true win (settled value 3)
                    $update_bets_query = "UPDATE `bets` SET `settled`= '3' WHERE ID = '$bet[bet_id]'";
                }
                $update_bets_result = mysqli_query($connection, $update_bets_query);
                //check to ensure this bet was settled
                if(mysqli_affected_rows($connection)){
                    $temp_arr = create_temp_successful_bet_array($bet['user_id'], $bet['bet_id'], $bet['win_amount'], 'true');
                }else{
                    $temp_arr = create_temp_successful_bet_array($bet['user_id'], $bet['bet_id'], $bet['win_amount'], 'false');
                }
            }else{
                $temp_arr = create_temp_successful_bet_array($bet['user_id'], $bet['bet_id'], $bet['win_amount'], 'false');
            }
        }else{
            //if the win_amount is less than 0 (theoretically equal to 0), no transaction is required. So we don't need to write a transaction query, but I still need to update the bets table to show bet is settled with a loss (settled value 1)
            $update_bets_query = "UPDATE `bets` SET `settled`= '1' WHERE ID = '$bet[bet_id]'";
            $update_bets_result = mysqli_query($connection, $update_bets_query);
            //check to ensure this bet was settled
            if(mysqli_affected_rows($connection)){
                $temp_arr = create_temp_successful_bet_array($bet['user_id'], $bet['bet_id'], $bet['win_amount'], 'true');
            }else{
                $temp_arr = create_temp_successful_bet_array($bet['user_id'], $bet['bet_id'], $bet['win_amount'], 'false');
            }
        }
        $bet_transactions[] = $temp_arr;
    }

//    print_r($data);       //working for when the page is all by itself
//    return $bets_data;
    return $bet_transactions;
}

//will return the amount of money won on the bet
//final score rendered as an array with first score representing away score and second the home team's score
//bet_first_side is a boolean value to determine if the player bet the first option in the bet type (i.e. bet away team in spread or money line and over in an over/under bet
function check_for_a_win($final_score_a, $final_score_h, $wager, $bet_type, $bet_side, $odds, $line){
    $win_amount = null;

    if ($bet_type === '1') {       //bet is on the spread
        $win_amount = check_spread_win($bet_side, $wager, $odds, $line, $final_score_a, $final_score_h);
    } else if ($bet_type === '2') {       //bet is on moneyline
        $win_amount = check_money_line_win($bet_side, $wager, $odds, $final_score_a, $final_score_h);
    } else {          //else bet is on over/under
        $win_amount = check_over_under_win($bet_side, $wager, $odds, $line, $final_score_a, $final_score_h);
    }
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

//maybe needs to be reverted to be focused around the under bet instead. Not sure how the games are added into db anymore


//checks for the win conditions of over/under bets
//an over bet is side 1, and and under bet is side 0 when written to db,
// so bet_over is true when it is side is 1 or bet is the over, and bet_over is false or 0 when side is 0 or is the under
function check_over_under_win($bet_over, $wager, $odds, $line, $final_score_a, $final_score_h){
    $total_score = $final_score_a + $final_score_h;
    if ($total_score > $line) { //only bets for the over win, other bets will return no money
        if ($bet_over) { //bet for over is true when not betting on the under
            $win_amount = calculate_win_total($wager, $odds);
        } else {
            $win_amount = 0;
        }
    } else if ($total_score < $line) { //only bets for the under win, other bets will return no money
        if (!$bet_over) {
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
//function to create a temporary array showing the success
function create_temp_successful_bet_array($user_id, $bet_id, $win_amount, $success){
    $temp_arr = [];
    $temp_arr['user_id'] = $user_id;
    $temp_arr['bet_id'] = $bet_id;
    $temp_arr['win_amount'] = $win_amount;       //regardless if there was a win still keep track that no money was won
    if($success){
        $temp_arr['success'] = 'true';
    }else{
        $temp_arr['success'] = 'false';
    }
    return $temp_arr;
}




//function to recheck all old games and correct them
function correct_wins_on_past_games($connection){
    $bets_query = "SELECT b.ID, b.user_id, b.amount, b.bet_type_id AS bet_type, b.side, b.line, b.odds, g.final_score_a, g.final_score_h, b.settled AS bet_status FROM `bets` AS b JOIN `games` AS g ON g.ID = b.game_id JOIN `bet_types` AS bt ON bt.ID = b.bet_type_id";
    $bets_result = mysqli_query($connection, $bets_query);

    //gather all bets data
    $bets_data = [];
    if (mysqli_num_rows($bets_result)) {
        while ($row = mysqli_fetch_assoc($bets_result)) {
            //create temp array
            $temp_arr = [];
            //store the bet id
            $temp_arr['bet_id'] = $row['ID'];
            //store user_id associated with the bet placed
            $temp_arr['user_id'] = $row['user_id'];
            //store wager associated with the bet placed
            $temp_arr['wager'] = $row['amount'];
            //store the bet status associated with the bet placed
            $temp_arr['bet_status'] = $row['bet_status'];
            //calculate the win amount for the specific bet and store in temp array
            $temp_arr['win_amount'] = check_for_a_win($row['final_score_a'], $row['final_score_h'], $row['amount'], $row['bet_type'], $row['side'], $row['odds'], $row['line']);
            //variable to track if bet was updated / for later use
            $temp_arr['bet_updated'] = 'false';
            //push the temp array to the data array
            $bets_data[] = $temp_arr;
        }
    }

//    $bet_transactions = [];

    //determine if a bet needs to be settled differently, create a query for bets that need to be resettled
    //recall that win amount from calculate_win_total is the win amount and the wager added together
    foreach ($bets_data as $bet){
        $bet_needs_rewritten = false;
        if($bet['win_amount'] > $bet['wager']){
            //if correct bet status is 3 (for a win)
            //check the current bet status
            if($bet['bet_status'] === 1){
                //current bet status is 1 for a loss
                $bet_needs_rewritten = true;
                //add win amount and bet amount
                $new_transaction_amt = $bet['win_amount'];
            }else if($bet['bet_status'] === 2){
                //current bet status is 2 for a push
                $bet_needs_rewritten = true;
                //add win amount
                $new_transaction_amt = $bet['win_amount'] - $bet['wager'];  //because win_amount already incorporates the wager
            }
        }else if ($bet['win_amount'] = 0){
            //if correct bet status is 1 (for a loss)
            //check the current bet status
            if($bet['bet_status'] === 2){
                //current bet status is 2 for a push
                $bet_needs_rewritten = true;
                //subtract bet amount
                $new_transaction_amt = -$bet['wager'];
            }else if($bet['bet_status'] === 3){
                //current bet status is 3 for a win
                $bet_needs_rewritten = true;
                //subtract win amount and bet amount
                $new_transaction_amt = -$bet['win_amount'];  //because win_amount already incorporates the wager
            }
        }else{
            //if correct bet status is 2 (for a push)
            //check the current bet status
            if($bet['bet_status'] === 1){
                //current bet status is 1 for a loss
                $bet_needs_rewritten = true;
                //add bet amount
                $new_transaction_amt = $bet['wager'];
            }else if($bet['bet_status'] === 3){
                //current bet status is 3 for a win
                $bet_needs_rewritten = true;
                //subtract win amount(just amount won without the wager included)
                $new_transaction_amt = -($bet['win_amount'] - $bet['wager']);
            }
        }

        if($bet_needs_rewritten){
            //if bet needs rewritten
            //make transaction to amend incorrect bet
            $transaction_query = "INSERT INTO `transactions`(`user_id`, `transaction`, `time`) VALUES ('$bet[user_id]', '$new_transaction_amt', NOW())";
            $transaction_result = mysqli_query($connection, $transaction_query);
            //if the transaction is successful, update the bet status
            if(mysqli_affected_rows($connection)){
                if($bet['win_amount'] === $bet['wager']) {
                    //win amount is the same as the wager, so the bet is a tie/push (settled value = 2)
                    $update_bets_query = "UPDATE `bets` SET `settled`= '2' WHERE ID = '$bet[bet_id]'";
                }else if($bet['win_amount'] > 0){
                    //win_amount is above 0, and will be above the wager, and hence a true win (settled value = 3)
                    $update_bets_query = "UPDATE `bets` SET `settled`= '3' WHERE ID = '$bet[bet_id]'";
                }else{
                    //win amount amount is 0, so the bet was lost (settled value = 1)
                    $update_bets_query = "UPDATE `bets` SET `settled`= '1' WHERE ID = '$bet[bet_id]'";
                }
                //update the db with the given query
                $update_bets_result = mysqli_query($connection, $update_bets_query);
                if(mssql_rows_affected($connection)){
                    //both bets table and transactions table successfully updated
                    $bet['bet_updated'] = 'true';
                }
            }
        }
    }

    return $bets_data;
}