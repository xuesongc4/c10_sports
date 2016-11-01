<?php 
require('curl_call_setup.php');

function odds_call($sportId, $leagueId) {
	global $httpChannel;
	$oddsUrl = 'https://api.pinnacle.com/v1/odds?sportid=' . $sportId . '&leagueids=' . $leagueId;
	$fixturesUrl = 'https://api.pinnacle.com/v1/fixtures?sportid=' . $sportId . '&leagueids=' . $leagueId;

	curl_setopt($httpChannel, CURLOPT_URL, $oddsUrl);
	$oddsFeed = curl_exec($httpChannel);

	curl_setopt($httpChannel, CURLOPT_URL, $fixturesUrl);
	$fixturesFeed = curl_exec($httpChannel);
	
	$gameList = [];
	$gameIds = [];

	$oddsDecoded = json_decode($oddsFeed);
	if (isset($oddsDecoded->leagues)) {
		$oddsEvents = $oddsDecoded->leagues[0]->events;
	}
		
	$fixturesDecoded = json_decode($fixturesFeed);
	if (isset($fixturesDecoded->league)) {
		// note this one is league without an 's' unlike the one above;
		$fixtureEvents = $fixturesDecoded->league[0]->events;
	}

	for ($i=0; $i<count($oddsEvents); $i++) {
		$game = [];
		$game['API_game_id'] = $oddsEvents[$i]->id;
		$gameIds[$oddsEvents[$i]->id] = $i;
		for ($j=0; $j<count($oddsEvents[$i]->periods); $j++) {
			if ($oddsEvents[$i]->periods[$j]->number === 0) {
				if (isset($oddsEvents[$i]->periods[$j]->spreads[0])) {
					$game['home_spread'] = $oddsEvents[$i]->periods[$j]->spreads[0]->hdp;
					$game['spread_odds_h'] = $oddsEvents[$i]->periods[$j]->spreads[0]->home;
					$game['spread_odds_a'] = $oddsEvents[$i]->periods[$j]->spreads[0]->away;
					break;
				}
			}
		}
	
		if (isset($oddsEvents[$i]->periods[$j]->moneyline)) {
			$game['moneyline_odds_h'] = $oddsEvents[$i]->periods[$j]->moneyline->home;
			$game['moneyline_odds_a'] = $oddsEvents[$i]->periods[$j]->moneyline->away;
		}

		if (isset($oddsEvents[$i]->periods[$j]->totals)) {
			$game['overunder_points'] = $oddsEvents[$i]->periods[$j]->totals[0]->points;
			$game['overunder_odds_o'] = $oddsEvents[$i]->periods[$j]->totals[0]->over;
			$game['overunder_odds_u'] = $oddsEvents[$i]->periods[$j]->totals[0]->under;
		}
		$gameList[] = $game;
	}

	for ($i=0; $i<count($fixtureEvents); $i++) {
		$event_id = $fixtureEvents[$i]->id;
		if(isset($gameIds[$event_id])){
			$starts = preg_replace("([TZ])", " ", $fixtureEvents[$i]->starts);
			$starts = substr($starts, 0,-1);
			$gameList[$gameIds[$event_id]]['game_time'] = $starts;
			$team_h = $fixtureEvents[$i]->home;
			$neutral = false;
			if (preg_match($team_h, '/\(n\)/')) {
				$team_h = substr($team_h, 0, -3);
				$neutral = true;
			}
			$gameList[$gameIds[$event_id]]['team_h'] = $team_h;
			$gameList[$gameIds[$event_id]]['team_a'] = $fixtureEvents[$i]->away;
			if ($neutral) {
				// do something about neutral condition
			}
		}
	}

	if ($sportId === 3) {
		for ($i=0; $i<count($fixtureEvents); $i++) {
			$event_id = $fixtureEvents[$i]->id;
			if(isset($gameIds[$event_id])){
				$gameList[$gameIds[$event_id]]['pitching_h'] =  $fixtureEvents[$i]->homePitcher;
				$gameList[$gameIds[$event_id]]['pitching_a'] =  $fixtureEvents[$i]->awayPitcher;
			}
		}
	}

	return $gameList;
}

function finished_games_call($sportId, $leagueId) {
	global $httpChannel;
	$settledUrl = 'https://api.pinnacle.com/v1/fixtures/settled?sportid=' . $sportId . '&leagueids=' . $leagueId;
	curl_setopt($httpChannel, CURLOPT_URL, $settledUrl);
	$settledFeed = curl_exec($httpChannel);
	$settledDecoded = json_decode($settledFeed);
	$gameList = [];
	if (isset($settledDecoded->leagues)) {
		$settledEvents = $settledDecoded->leagues[0]->events;
		for ($i=0; $i<count($settledEvents); $i++) {
			for ($j=0; $j<count($settledEvents[$i]->periods); $j++) {
				if ($settledEvents[$i]->periods[$j]->number == 0) {
					$game = [];
					$game['API_game_id'] = $settledEvents[$i]->id;
					$game['final_score_h'] = $settledEvents[$i]->periods[$j]->team2Score;
					$game['final_score_a'] = $settledEvents[$i]->periods[$j]->team1Score;
					$gameList[] = $game;
					break;
				}
			}
		}
	}
	return $gameList;
}
 ?>