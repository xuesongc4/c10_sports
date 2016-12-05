<?php
//execution of the method to correct old, bad bet results
print('<pre>');
print_r(correct_wins_on_past_games($connection));
print('</pre>');

//function to recheck all old games and correct them
function correct_wins_on_past_games($connection)
{
    //gather all bets data
    $bets_query = "SELECT b.ID AS bet_id, b.user_id, b.amount AS wager, b.bet_type_id AS bet_type, b.side, b.line, b.odds, g.final_score_a, g.final_score_h, b.settled AS bet_status FROM `bets` AS b JOIN `games` AS g ON g.ID = b.game_id JOIN `bet_types` AS bt ON bt.ID = b.bet_type_id WHERE b.settled != 0 ORDER BY b.ID";
    $bets_result = mysqli_query($connection, $bets_query);
    //create empty array to store only bets that need amending
    $bets_to_rewrite = [];

    if (mysqli_num_rows($bets_result)) {
        while ($row = mysqli_fetch_assoc($bets_result)) {
            $correct_win_amount = check_for_a_win($row['final_score_a'], $row['final_score_h'], $row['wager'], $row['bet_type'], $row['side'], $row['odds'], $row['line']);
            $new_transaction_amt = calculate_transaction_amount($row['wager'], $correct_win_amount, $row['bet_status'], $row['odds']);
            if ($new_transaction_amt !== 0) {
                //collect data from bet info that is necessary to rewrite bet and write transaction
                $temp_arr = [];
                $temp_arr['user_id'] = $row['user_id'];
                $temp_arr['bet_id'] = $row['bet_id'];
                $temp_arr['win_amount'] = $correct_win_amount;
                $temp_arr['wager'] = $row['wager'];
                $temp_arr['transaction_amt'] = $new_transaction_amt;
                $temp_arr['bet_updated'] = false;
                $bets_to_rewrite[] = $temp_arr;
            }
        }
    }

    //determine if a bet needs to be settled differently, create a query for bets that need to be resettled
    //recall that win amount from calculate_win_total is the win amount and the wager added together
    foreach ($bets_to_rewrite as $bet) {
        //make transaction to amend incorrect bet
        $transaction_query = "INSERT INTO `transactions`(`user_id`, `transaction`, `time`) VALUES ('$bet[user_id]', '$bet[transaction_amt]', NOW())";
        $transaction_result = mysqli_query($connection, $transaction_query);
        //if the transaction is successful, update the bet status
        if (mysqli_affected_rows($connection)) {
            if ($bet['win_amount'] === $bet['wager']) {
                //win amount is the same as the wager, so the bet is a tie/push (settled value = 2)
                $update_bets_query = "UPDATE `bets` SET `settled`= '2' WHERE ID = '$bet[bet_id]'";
            } else if ($bet['win_amount'] > 0) {
                //win_amount is above 0, and will be above the wager, and hence a true win (settled value = 3)
                $update_bets_query = "UPDATE `bets` SET `settled`= '3' WHERE ID = '$bet[bet_id]'";
            } else {
                //win amount amount is 0, so the bet was lost (settled value = 1)
                $update_bets_query = "UPDATE `bets` SET `settled`= '1' WHERE ID = '$bet[bet_id]'";
            }
            //update the db with the given query
            $update_bets_result = mysqli_query($connection, $update_bets_query);
            if (mysqli_affected_rows($connection)) {
                //both bets table and transactions table successfully updated
                $bet['bet_updated'] = true;
            }
        }
    }
    return $bets_to_rewrite;
}

//determines the value of a transaction of a bet that has already been paid out
//it is intended for use in determining faulty payouts
//if the bet needs rewriting it will return a non-zero number associated with how far off the original payout was
//if the bet does not need rewritten, method will return 0
function calculate_transaction_amount($wager, $win_amount, $bet_status, $odds)
{
    if ($win_amount > $wager) {
        //if correct bet status is 3 (for a win)
        //check the current bet status
        if ($bet_status === '3') {
            //bet status is correctly a 3 (for a win)
            $new_transaction_amt = 0;
        } else if ($bet_status === '1') {
            //current bet status is 1 for a loss
            //add win amount and bet amount
            $new_transaction_amt = $win_amount;
        } else {
            //current bet status is 2 for a push
            //add win amount
            $new_transaction_amt = $win_amount - $wager;  //because win_amount already incorporates the wager
        }
    } else if ($win_amount === 0) {
        //if correct bet status is 1 (for a loss)
        //check the current bet status
        if ($bet_status === '1') {
            //bet status is correctly a 1 (for a loss)
            $new_transaction_amt = 0;
        } else if ($bet_status === '2') {
            //current bet status is 2 for a push
            //subtract bet amount
            $new_transaction_amt = -$wager;
        } else {
            //current bet status is 3 for a win
            //subtract win amount that was paid out and amount bet (wager)
                //old win amount needs to be determined in order to know how much to deduct
            $win_amount = calculate_win_total($wager, $odds);
            $new_transaction_amt = -$win_amount;  //because win_amount already incorporates the wager
        }
    } else {
        //if correct bet status is 2 (for a push)
        //check the current bet status
        if ($bet_status === '2') {
            //bet status is correctly a 2 (for a push)
            $new_transaction_amt = 0;
        } else if ($bet_status === '1') {
            //current bet status is 1 for a loss
            //add the amount bet (wager)
            $new_transaction_amt = $wager;
        } else {
            //current bet status is 3 for a win
            //subtract win amount(just amount won without the wager included)
                //old win amount needs to be determined in order to know how much to deduct
            $win_amount = calculate_win_total($wager, $odds);
            $new_transaction_amt = -($win_amount - $wager);
        }
    }
    return $new_transaction_amt;
}

?>