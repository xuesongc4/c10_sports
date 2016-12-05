<?php
require_once('check_wins.php');      //necessary when testing it on its own
date_default_timezone_set('UTC');

/*//testing       lions, vikings sun nov 6 2016
$LionsToWin = check_for_a_win(22, 16, 100, 'moneyline', 0, 217, 217);
print($LionsToWin);
print('<br>');

//testing       knicks v cavs under 43.5
//function check_for_a_win($final_score_a, $final_score_h, $wager, $bet_type, $bet_side, $odds, $line)
$under_bet = check_for_a_win(88, 117, 100, 'over/under', 0, 100, 43.5);
print($under_bet);
print('<br>');

//testing       saints at 49ers under 53
$under_bet = check_for_a_win(41, 23, 100, 'over/under', 0, 100, 53);
print($under_bet);
print('<br>');

//testing       ravens at cowboys over 45
$over_bet = check_for_a_win(17, 27, 100, 'over/under', 1, -105, 45);
print($over_bet);
print('<br>');

//testing       ravens at cowboys under 45
$under_bet = check_for_a_win(17, 27, 100, 'over/under', 0, -105, 45);
print($under_bet);
print('<br>');*/

//function check_for_a_win($final_score_a, $final_score_h, $wager, $bet_type, $bet_side, $odds, $line)
//testing       heat at wizards  -5   bet on heat
//$heat_bet = check_for_a_win(114, 111, 100, 'spread', 0, -108, -5);
//$heat_bet = check_for_a_win(114, 111, 100, 1, 0, -108, -4.5);
//print($heat_bet);
//print('<br>');

//testing       heat at wizards  -5   bet on wizards
//$wizards_bet = check_for_a_win(114, 111, 100, 1, 1, -108, -5);
//$wizards_bet = check_for_a_win(114, 111, 100, 'spread', 1, -108, -4.5);
//print($wizards_bet);
//print('<br>');


//call of function that will check all old games for accuracy
//correct_wins_on_past_games($connection);

//in order to be effective i need an input of game_id to cut down on the games to look at
// the file db_query has a portion that checks if games are completed, after this point it should call this file to

//check_for_wins_on_settled_games(140);       //necessary when testing it on its own  (old for when using our game ID)
//check_for_wins_on_settled_games(654458760);       //necessary when testing it on its own  (new for when using their game ID)

//for testing purposes of the method to correct old, bad bet results
print('<pre>');
print_r(correct_wins_on_past_games($connection));
print('</pre>');

//function to recheck all old games and correct them
function correct_wins_on_past_games($connection){
    $bets_query = "SELECT b.ID, b.user_id, b.amount AS wager, b.bet_type_id AS bet_type, b.side, b.line, b.odds, g.final_score_a, g.final_score_h, b.settled AS bet_status FROM `bets` AS b JOIN `games` AS g ON g.ID = b.game_id JOIN `bet_types` AS bt ON bt.ID = b.bet_type_id WHERE b.settled != 0 ORDER BY b.ID";
    $bets_result = mysqli_query($connection, $bets_query);

    //gather all bets data
//    $bets_data = [];
//    $rewritten_bets = [];


    $bets_to_rewrite = [];

    if (mysqli_num_rows($bets_result)) {
//        echo 'getting bet results';
        while ($row = mysqli_fetch_assoc($bets_result)) {
            $win_amount = check_for_a_win($row['final_score_a'], $row['final_score_h'], $row['wager'], $row['bet_type'], $row['side'], $row['odds'], $row['line']);
            $temp_arr = [];
            $temp_arr['bet_id'] = $row['ID'];
            $temp_arr['win_amount'] = $win_amount;
            $temp_arr['wager'] = $row['wager'];
            $temp_arr['bet_status'] = $row['bet_status'];

            $new_transaction_amt = find_new_transaction_amount($row['wager'], $win_amount, $row['bet_status']);
            $temp_arr['transaction_amt'] = $new_transaction_amt;

            $bets_to_rewrite[] = $temp_arr;
//            print('bet_id: ');
//            print($row['ID']);
//            print(', wager: ');
//            print($row['wager']);
//            print(', bet_status: ');
//            print($row['bet_status']);
////            print($new_transaction_amt);
//            print('<br>');

//            if($new_transaction_amt != 0){
////                echo 'new transaction';
//                //create temp array
//                $temp_arr = [];
//                //store the bet id
//                $temp_arr['bet_id'] = $row['ID'];
//                //store user_id associated with the bet placed
//                $temp_arr['user_id'] = $row['user_id'];
//                //store wager associated with the bet placed
//                $temp_arr['wager'] = $row['wager'];
//                //store the bet status associated with the bet placed
//                $temp_arr['bet_status'] = $row['bet_status'];
//                //store the win amount in the temp array
//                $temp_arr['win_amount'] = $win_amount;
//                //variable to track if bet was updated / for later use
//                $temp_arr['bet_updated'] = 'false';
//                //store the new transaction amount associated with the bet
//                $temp_arr['transaction_amt'] = $new_transaction_amt;
//
//                //push the temp array to the data array
//                $bets_to_rewrite[] = $temp_arr;
//            }
        }
    }

    return $bets_to_rewrite;
//
////    $bet_transactions = [];
//
//    //determine if a bet needs to be settled differently, create a query for bets that need to be resettled
//    //recall that win amount from calculate_win_total is the win amount and the wager added together
//    foreach ($bets_data as $bet){
////        $bet_needs_rewritten = false;
//        $new_transaction_amt = find_new_transaction($bet['win_amount'], $bet['wager'], $bet['bet_status']);
//
//        if($new_transaction_amt !== 0){
//            echo 'a bet needs rewritten';
//            //if bet needs rewritten
//            $rewritten_bets[] = $bet;
//            //make transaction to amend incorrect bet
//            $transaction_query = "INSERT INTO `transactions`(`user_id`, `transaction`, `time`) VALUES ('$bet[user_id]', '$new_transaction_amt', NOW())";
//            $transaction_result = mysqli_query($connection, $transaction_query);
//            //if the transaction is successful, update the bet status
//            if(mysqli_affected_rows($connection)){
//                if($bet['win_amount'] === $bet['wager']) {
//                    //win amount is the same as the wager, so the bet is a tie/push (settled value = 2)
//                    $update_bets_query = "UPDATE `bets` SET `settled`= '2' WHERE ID = '$bet[bet_id]'";
//                }else if($bet['win_amount'] > 0){
//                    //win_amount is above 0, and will be above the wager, and hence a true win (settled value = 3)
//                    $update_bets_query = "UPDATE `bets` SET `settled`= '3' WHERE ID = '$bet[bet_id]'";
//                }else{
//                    //win amount amount is 0, so the bet was lost (settled value = 1)
//                    $update_bets_query = "UPDATE `bets` SET `settled`= '1' WHERE ID = '$bet[bet_id]'";
//                }
//                //update the db with the given query
//                $update_bets_result = mysqli_query($connection, $update_bets_query);
//                if(mysqli_affected_rows($connection)){
//                    //both bets table and transactions table successfully updated
//                    $bet['bet_updated'] = 'true';
//                }
//            }
//        }
//    }
//
//    return $rewritten_bets;
//    return $bets_data;
}

//determines the value of a transaction of a bet that has already been paid out
//it is intended for use in determining faulty payouts
//if the bet needs rewriting it will return a non-zero number associated with how far off the original payout was
//if the bet does not need rewritten, method will return 0
function find_new_transaction_amount($wager, $win_amount, $bet_status){
//        $bet_needs_rewritten = false;
//    $bet_needs_rewritten = 'false';
    if($win_amount > $wager){
        //if correct bet status is 3 (for a win)
        //check the current bet status
        if($bet_status === 1){
            //current bet status is 1 for a loss
//                $bet_needs_rewritten = true;
//            $bet_needs_rewritten = 'true';
            //add win amount and bet amount
            $new_transaction_amt = $win_amount;
        }else if($bet_status === 2){
            //current bet status is 2 for a push
//                $bet_needs_rewritten = true;
//            $bet_needs_rewritten = 'true';
            //add win amount
            $new_transaction_amt = $win_amount - $wager;  //because win_amount already incorporates the wager
        }else{
            $new_transaction_amt = 0;
        }
    }else if ($win_amount === 0){
        //if correct bet status is 1 (for a loss)
        //check the current bet status
        if($bet_status === 2){
            //current bet status is 2 for a push
//                $bet_needs_rewritten = true;
//            $bet_needs_rewritten = 'true';
            //subtract bet amount
            $new_transaction_amt = -$wager;
        }else if($bet_status === 3){
            //current bet status is 3 for a win
//                $bet_needs_rewritten = true;
//            $bet_needs_rewritten = 'true';
            //subtract win amount and bet amount
            $new_transaction_amt = -$win_amount;  //because win_amount already incorporates the wager
        }else{
            $new_transaction_amt = 0;
        }
    }else{
        //if correct bet status is 2 (for a push)
        //check the current bet status
        if($bet_status === 1){
            //current bet status is 1 for a loss
//                $bet_needs_rewritten = true;
//            $bet_needs_rewritten = 'true';
            //add bet amount
            $new_transaction_amt = $wager;
        }else if($bet_status === 3){
//            print('push marked as a win');
//            print('<br>');
            //current bet status is 3 for a win
//                $bet_needs_rewritten = true;
//            $bet_needs_rewritten = 'true';
            //subtract win amount(just amount won without the wager included)
            $new_transaction_amt = -($win_amount - $wager);
        }else{
            $new_transaction_amt = 0;
        }
    }
    return $new_transaction_amt;
//    if($bet_needs_rewritten){
//        return $new_transaction_amt;
//    }else{
//        return 0;
//    }
}