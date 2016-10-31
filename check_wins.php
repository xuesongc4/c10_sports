<?php

//make function to format the incoming bet

//function check_the_winnings_of_bet(bet_number){
//// console.log('ima check the winnings');
//    $.ajax({
//        url: 'dummy_bet_data.php',
//        method: 'post',
//        dataType: 'json',
//        data: {
//            bet_id: 0
//        },
//        success: function (response) {
//            console . log('reached the server');
//            console . log(response);
//            //need to change game and final score
//                console . log(check_wins('game', [40, 30], +response . wager, +response . type_of_bet, response . side, +response . odds, +response . line));
//            },
//        error: function (response) {
//                console . log('FAILED to reach the server');
//            }
//    });
//}

//will return the amount of money won on the bet
//final score rendered as an array with first score representing away score and second the home team's score
//bet_first_side is a boolean value to determine if the player bet the first option in the bet type (i.e. bet away team in spread or money line and over in an over/under bet
function check_wins($game, $final_score, $wager, $bet_type, $bet_first_side, $odds, $line){
    $win_amount = null;
    if ($bet_type === 'over_under') {
        $win_amount = check_over_under_win($bet_first_side, $wager, $odds, $line, $final_score);
    } else if ($bet_type === 'spread') {       //bet is on spread
        $win_amount = check_spread_win($bet_first_side, $wager, $odds, $line, $final_score);
    } else {          //else bet is on money line
        $win_amount = check_money_line_win($bet_first_side, $wager, $odds, $final_score);
    }
    console . log('win_amount: ', $win_amount);
}

function check_over_under_win($bet_over , $wager, $odds, $line, $final_score){
    $total_score = $final_score[0] + $final_score[1];
    if ($total_score > $line) { //only bets for the over win, other bets will return no money
        if ($bet_over) { //bet for first side is true when the over is bet on
            $win_amount = calculate_win_total($wager, $odds);
        } else {
            $win_amount = 0;
        }
    } else if ($total_score < $line) { //only bets for the under win, other bets will return no money
        if (!$bet_over) { //bet for first side is false when the under is bet on
            $win_amount = calculate_win_total($wager, $odds);
        } else {
            $win_amount = 0;
        }
    } else {  //a push occurs and you get your money back, one is unable to place a bet on a tie (i believe, at least in this type of bet)
        $win_amount = $wager;
    }
    return $win_amount;
}

/* to check spread:
1) always add line to the home side in final score
2) find out what side we bet on
3) compare appended final scores. side we bet on must be strictly greater than other side*/
function check_spread_win($bet_away, $wager, $odds, $line, $final_score){
    $win_amount = null;
    $final_score[1] += $line;
    if ($bet_away) {  //bet is for away team
        if ($final_score[0] > $final_score[1]) {
            $win_amount = calculate_win_total($wager, $odds);
        } else if ($final_score[0] < $final_score[1]) {
            $win_amount = 0;
        } else {
            $win_amount = $wager;
        }
    } else {      //bet is for away team
        if ($final_score[0] < $final_score[1]) {
            $win_amount = calculate_win_total($wager, $odds);
        } else if ($final_score[0] > $final_score[1]) {
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
function check_money_line_win($bet_away, $wager, $odds, $final_score){
    $win_amount = null;
    if ($bet_away) {
        if ($final_score[0] > $final_score[1]) {        //away team wins
            $win_amount = calculate_win_total($wager, $odds);
        } else if ($final_score[0] < $final_score[1]) {  //home team wins
            $win_amount = 0;
        } else {                                      //tie
            $win_amount = $wager;
        }
    } else {
        if ($final_score[0] < $final_score[1]) {        //home team wins
            $win_amount = calculate_win_total($wager, $odds);
        } else if ($final_score[0] > $final_score[1]) {  //away team wins
            $win_amount = 0;
        } else {                                      //tie
            $win_amount = $wager;
        }
    }
    return $win_amount;
}

function calculate_win_total($bet_amount, $odds) {
    $win = null;
    if ($odds < 0) {
        $odds *= -1;
        $win = 100 / $odds * $bet_amount;
    } else {
        $win = $odds / 100 * $bet_amount;
    }
    return $bet_amount + $win;
}

//        //check_wins($game, $final_score, $amount, $bet_type, $bet_first_side, $odds, $line)
//        check_wins(1, [8,40], 100, 'over_under', true, -110, 47);
//        check_wins(1, [8,40], 100, 'over_under', false, -110, 47);

//        //check_wins($game, $final_score, $amount, $bet_type, $bet_first_side, $odds, $line)
//        check_wins(1, [100,3], 100, 'spread', true, -110, -10); //expect lose
//        check_wins(1, [60,70], 100, 'spread', false, -110, -10);

//        //check_wins($game, $final_score, $amount, $bet_type, $bet_first_side, $odds, $line)
// check_wins(1, [100,3], 100, 'money_line', true, 450); // no line in money line because it is already incorporated//expect win
// check_wins(1, [85,70], 100, 'money_line', true, -300);

?>