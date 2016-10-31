<?php 
require('api_calls.php');

function make_query($spordId, $leagueId) {
	$api_settled = finished_games_call($spordId, $leagueId);
	$api_upcoming = odds_call($spordId, $leagueId);

	$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	date_default_timezone_set('UTC');
	$date_object = date_create();
	$yesterday_timestamp = date_timestamp_get($date_object) - 86400;
	date_timestamp_set($date_object, $yesterday_timestamp);
	$yesterday_date = date_format($date_object, 'Y-m-d H:i:s');
	$select_query = "SELECT * FROM games WHERE game_time > '$yesterday_date' AND league_id = $leagueId";
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
		$select_query = "SELECT final_score_h FROM games WHERE API_game_id = {$settled_game['API_game_id']}";
		$select_result = mysqli_query($connection, $select_query);
		if (mysqli_num_rows($select_result) > 0) {
			$row = mysqli_fetch_assoc($select_result);
			if ($row['final_score_h'] != $settled_game['final_score_h']) {
				$update_query = "UPDATE games SET final_score_h = {$settled_game['final_score_h']}, final_score_a = {$settled_game['final_score_a']} WHERE API_game_id = {$settled_game['API_game_id']}";
				mysqli_query($connection, $update_query);
				echo $update_query;
				echo "<br>";
			}
		}
	}

	/*
	  Make an array of uniqute matchups because the API returns multiple game ids for single games (different game ids can refer to the same game)
	*/
	$db_matchups = [];
	foreach($db_upcoming as $db_game) {
		$matchup = [];
		$matchup['team_h_id'] = $db_game['team_h_id'];
		$matchup['team_a_id'] = $db_game['team_a_id'];
		$db_matchups[] = $matchup;
	}

	/*
  	checks if property data has changed and updates if so
	*/
	function propertyCheck($connection, $db_game, $api_game, $prop) {
		// global $connection;
		// print_r($connection);
		// echo "<br>";
		if (!isset($api_game[$prop])) {
			$api_game[$prop] = 0;
		}
		if ($db_game[$prop] != $api_game[$prop]) {
			$update_query = "UPDATE `games` SET `{$prop}` = {$api_game[$prop]} WHERE `API_game_id` = {$db_game['API_game_id']}";
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
				propertyCheck($connection, $db_game, $api_game, 'home_spread');
				propertyCheck($connection, $db_game, $api_game, 'spread_odds_a');
				propertyCheck($connection, $db_game, $api_game, 'spread_odds_h');
				propertyCheck($connection, $db_game, $api_game, 'moneyline_odds_a');
				propertyCheck($connection, $db_game, $api_game, 'moneyline_odds_h');
				propertyCheck($connection, $db_game, $api_game, 'overunder_points');
				propertyCheck($connection, $db_game, $api_game, 'overunder_odds_o');
				propertyCheck($connection, $db_game, $api_game, 'overunder_odds_u');
				$gameIdFound = true;
				break;
			}
		}
		if (!$gameIdFound) {
			// echo "Game id not found";
			// echo "<br>";
			$home_id_query = "SELECT * FROM teams WHERE fullName = '{$api_game['team_h']}'";
			$home_result = mysqli_query($connection, $home_id_query);
			$row = mysqli_fetch_assoc($home_result);
			$home_id = $row['ID'];
			$away_id_query = "SELECT * FROM teams WHERE fullName = '{$api_game['team_a']}'";
			$result = mysqli_query($connection, $away_id_query);
			$row = mysqli_fetch_assoc($result);
			$away_id = $row['ID'];
			// echo "home id: " . $home_id;
			// echo "<br>";
			// echo "away id: " . $away_id;
			// echo "<br>";
			$matchupFound = false;
			/*
		    inner for loop that if this new game Id already matches a matchup already in database (different game ids can refer to the same game)
			*/
			foreach($db_matchups as $matchup) {
				if ($matchup['team_h_id'] == $home_id && $matchup['team_a_id'] == $away_id) {
					// echo "Matchup found: " . $api_game['API_game_id'];
					// echo "<br>";
					$matchupFound = true;
					break;
				}
			}
			if (!$matchupFound) {
				// echo "not found";
				// echo "<br>";

				/*
			    adds new game if matchup not found
				*/
				$properties = 'API_game_id, league_id, team_h_id, team_a_id, game_time, home_spread, spread_odds_h, spread_odds_a, moneyline_odds_h, moneyline_odds_a, overunder_points, overunder_odds_o, overunder_odds_u';
				$values = "{$api_game['API_game_id']}, {$leagueId}, {$home_id}, {$away_id}, ";

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
				$insert_query = 'INSERT INTO games ' . '(' . $properties . ')' . ' VALUES ' . '(' . $values . ')'; 
				mysqli_query($connection, $insert_query);
				echo $insert_query;
				echo "<br>";
			}	
	  }
	}
}

make_query(15,889);
// make_query(4,487);
 ?>