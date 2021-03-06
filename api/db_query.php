<?php 
require('api_calls.php');
require('check_wins.php');
date_default_timezone_set('UTC');

/*
	checks if property data has changed and updates if so
*/
function propertyCheck($connection, $db_game, $api_game, $prop) {
	if (!isset($api_game[$prop])) {
		$api_game[$prop] = 0;
	}
	if ($db_game[$prop] != $api_game[$prop]) {
		$update_query = "UPDATE ";
		if ($prop === 'pitching_h' || $prop === 'pitching_a') {
			$update_query .= "pitching_matchups SET {$prop} = '{$api_game[$prop]}' ";
		} else if ($prop === 'game_time') {
			// if property is 'game_time' set property as a string
			$update_query .= "games SET game_time = '{$api_game['game_time']}' ";
		} else {
			// all other properties set as a number
			$update_query .= "games SET {$prop} = {$api_game[$prop]} ";
		}
		$update_query .= "WHERE `API_game_id` = {$db_game['API_game_id']}";
		echo $update_query;
		echo "<br>";
		mysqli_query($connection, $update_query);
	}
}

/*
  concatenates a string containing values to be used in an insert query for new games
*/
function concatenateValues(&$values, $api_game, $prop) {
	if (isset($api_game[$prop])) {
		$values .= "{$api_game[$prop]}, ";
	} else {
		$values .= '0, ';
	}
}

function make_query($connection, $spordId, $leagueId) {
	// data from api
	$api_settled = finished_games_call($spordId, $leagueId);            //important and necessary   //comment out when running kyle's code below

//    //this is stuff Kyle wrote to test the checking of bets after they are settled
//    //start kyle's test code
//    $gameList = [];
//    $game = [];
//    $game['API_game_id'] = 657667126;
//    $game['final_score_h'] = 104;
//    $game['final_score_a'] = 127;       //true score
////    $game['final_score_a'] = 225 - 104;       //fake score to test over/under push
//    $gameList[] = $game;
//    $api_settled = $gameList;
//    //end kyle's test code

	$api_upcoming = odds_call($spordId, $leagueId);


	// connect to database
	// $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// query database for all games within the past 24 hours and upcoming games
	date_default_timezone_set('UTC');
	$yesterday_date = date('Y-m-d H:i:s', time() - 86400);
	$select_query = "SELECT * FROM games WHERE game_time > '$yesterday_date' AND league_id = $leagueId";
	// different query for baseball to include starting pitchers
	if ($spordId === 3) {
		$select_query = "SELECT g.API_game_id AS API_game_id, g.team_h_id AS team_h_id, g.team_a_id AS team_a_id, p.pitching_h AS pitching_h, p.pitching_a AS pitching_a, g.game_time AS game_time, g.home_spread AS home_spread, g.spread_odds_h AS spread_odds_h, g.spread_odds_a AS spread_odds_a, g.moneyline_odds_h AS moneyline_odds_h, g.moneyline_odds_a AS moneyline_odds_a, g.overunder_points AS overunder_points, g.overunder_odds_o AS overunder_odds_o, g.overunder_odds_u AS overunder_odds_u FROM games AS g JOIN pitching_matchups as p ON g.API_game_id = p.API_game_id WHERE game_time > '$yesterday_date' AND league_id = $leagueId";
	}
	$db_upcoming = [];
	$result = mysqli_query($connection, $select_query);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$db_upcoming[] = $row;
		}
	}
	// echo "<pre>";
	// print_r($api_upcoming);
	// echo "</pre>";

	/*
  Set final scores for finished games
	*/
	foreach($api_settled as $settled_game) {
		$select_query = "SELECT final_score_h, final_score_a FROM games WHERE API_game_id = {$settled_game['API_game_id']}";
		$select_result = mysqli_query($connection, $select_query);

		if (mysqli_num_rows($select_result) > 0) {
			$row = mysqli_fetch_assoc($select_result);
			if ($row['final_score_h'] != $settled_game['final_score_h']) {
				$update_query = "UPDATE games SET final_score_h = {$settled_game['final_score_h']}, final_score_a = {$settled_game['final_score_a']} WHERE API_game_id = {$settled_game['API_game_id']}";
				mysqli_query($connection, $update_query);

				echo $update_query;
				echo "<br>";
                //runs a query to check wins in the bet table and prints the settled bets
                echo "<pre>";
                print_r(check_for_wins_on_settled_games($connection, $settled_game['API_game_id']));
                echo "</pre><br>";
			}
		}
	}

	/*
	  Make an array of unique hometeams plus gametimes because the API returns multiple game ids for single games (different game ids can refer to the same game)
	*/
	$db_gametimes = [];
	foreach($db_upcoming as $db_game) {
		$game = [];
		$game['team_h_id'] = $db_game['team_h_id'];
		$game['game_time'] = $db_game['game_time'];
		$db_gametimes[] = $game;
	}

	/*
  	outer for loop that checks to see if games need to be updated or new games should be added
	*/
	foreach($api_upcoming as $api_game) {
		$gameIdFound = false;

		/*
	    inner for loop that checks to see if games need to be updated
		*/
		foreach($db_upcoming as $db_game) {
			if ($db_game['API_game_id'] == $api_game['API_game_id']) {
				propertyCheck($connection, $db_game, $api_game, 'game_time');
				propertyCheck($connection, $db_game, $api_game, 'home_spread');
				propertyCheck($connection, $db_game, $api_game, 'spread_odds_a');
				propertyCheck($connection, $db_game, $api_game, 'spread_odds_h');
				propertyCheck($connection, $db_game, $api_game, 'moneyline_odds_a');
				propertyCheck($connection, $db_game, $api_game, 'moneyline_odds_h');
				propertyCheck($connection, $db_game, $api_game, 'overunder_points');
				propertyCheck($connection, $db_game, $api_game, 'overunder_odds_o');
				propertyCheck($connection, $db_game, $api_game, 'overunder_odds_u');
				if ($spordId === 3) {
					propertyCheck($connection, $db_game, $api_game, 'pitching_h');
					propertyCheck($connection, $db_game, $api_game, 'pitching_a');
				}
				$gameIdFound = true;
				break;
			}
		}
		if (!$gameIdFound) {
			$home_id_query = "SELECT * FROM teams WHERE full_name = '{$api_game['team_h']}'";
			$home_result = mysqli_query($connection, $home_id_query);
			$row = mysqli_fetch_assoc($home_result);
			$home_id = $row['ID'];
			$gametimeFound = false;

			/*
		    inner for loop that if this new game Id already matches a game already in database (different game ids can refer to the same game)
			*/
			foreach($db_gametimes as $game) {
				if ($game['team_h_id'] == $home_id && $game['game_time'] == $api_game['game_time']) {
					$gametimeFound = true;
					break;
				}
			}
			if (!$gametimeFound) {
				$away_id_query = "SELECT * FROM teams WHERE full_name = '{$api_game['team_a']}'";
				$away_result = mysqli_query($connection, $away_id_query);
				$row = mysqli_fetch_assoc($away_result);
				$away_id = $row['ID'];
				
				/*
			    adds new game if game not found
				*/
				$properties = 'API_game_id, league_id, team_h_id, team_a_id, final_score_h, final_score_a, game_time, home_spread, spread_odds_h, spread_odds_a, moneyline_odds_h, moneyline_odds_a, overunder_points, overunder_odds_o, overunder_odds_u';
				$values = "{$api_game['API_game_id']}, {$leagueId}, {$home_id}, {$away_id}, -1, -1, ";

				if (isset($api_game['game_time'])) {
					$values .= "'{$api_game['game_time']}', ";
				} else {
					$values .= "'3000-01-01 00:00:00', ";
				}
				concatenateValues($values, $api_game, 'home_spread');
				concatenateValues($values, $api_game, 'spread_odds_h');
				concatenateValues($values, $api_game, 'spread_odds_a');
				concatenateValues($values, $api_game, 'moneyline_odds_h');
				concatenateValues($values, $api_game, 'moneyline_odds_a');
				concatenateValues($values, $api_game, 'overunder_points');
				concatenateValues($values, $api_game, 'overunder_odds_o');
				concatenateValues($values, $api_game, 'overunder_odds_u');
				$values = substr($values, 0, -2);
				$insert_query = "INSERT INTO games ({$properties}) VALUES ({$values})";
				mysqli_query($connection, $insert_query);
				echo $insert_query;
				echo "<br>";
				if ($spordId === 3) {
					$insert_query = "INSERT INTO pitching_matchups (API_game_id, pitching_h, pitching_a) VALUES ({$api_game['API_game_id']}, '{$api_game['pitching_h']}', '{$api_game['pitching_a']}')";
					mysqli_query($connection, $insert_query);
					echo $insert_query;
					echo "<br>";
				}
			}
	  }
	}
}


// $today_date = date('m-d', time());

// if ($today_date > '09-01' || $today_date < '02-10') {
// 	// make_query($connection, 15, 889);
// }

// if ($today_date > '10-25' || $today_date < '06-25') {
// 	 make_query($connection, 4, 487);
// }

// if ($today_date > '03-21' && $today_date < '11-05') {
// 	// make_query($connection, 3, 246);
// }

 ?>