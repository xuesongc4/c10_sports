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

