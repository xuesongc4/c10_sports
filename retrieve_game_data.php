<?php
require_once('mysql_connect.php');
date_default_timezone_set('UTC');





//print_r($result);





//create empty object
$data = [];

//full data attempt
//"SELECT t.full_name, t.abbr_name, t.logo_src FROM `teams` AS t JOIN `games` AS g ON g.team_a_id = t.ID OR g.team_h_id = t.ID WHERE g.league_id = 1"


//gather away team info
$away_team_info_query = "SELECT t.full_name, t.abbr_name, t.logo_src FROM `teams` AS t JOIN `games` AS g ON g.team_a_id = t.ID WHERE g.league_id = 1";
$result = mysqli_query($conn, $away_team_info_query);
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)){
        $data['away'][] = $row;
//        print_r($row);
//        print("<br>");
    }
//    foreach ($row)
//    print("<br><br>");
//    print_r($data);

    //json encode the object
}
//gather home team info
$home_team_info_query = "SELECT t.full_name, t.abbr_name, t.logo_src FROM `teams` AS t JOIN `games` AS g ON g.team_h_id = t.ID WHERE g.league_id = 1";
$result = mysqli_query($conn, $home_team_info_query);
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)){
        $data['home'][] = $row;
    }
}
//gather betting info
//gather spread info
$spread_query = "SELECT home_spread, spread_odds_a, spread_odds_h FROM `games` WHERE league_id = '1'";
$result = mysqli_query($conn, $spread_query);
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)){
        $data['bets']['spread'][] = $row;
    }
}
//gather moneyline info
$moneyline_query = "SELECT moneyline_odds_a, moneyline_odds_h FROM `games` WHERE league_id = '1'";
$result = mysqli_query($conn, $moneyline_query);
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)){
        $data['bets']['moneyline'][] = $row;
    }
}
//gather over under info
$overunder_query = "SELECT overunder_points, overunder_odds_o, overunder_odds_u FROM `games` WHERE league_id = '1'";
$result = mysqli_query($conn, $overunder_query);
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)){
        $data['bets']['overunder'][] = $row;
    }
}
//gather other game info
$game_query = "SELECT date FROM `games` WHERE league_id = '1'";
$result = mysqli_query($conn, $game_query);
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)){
        $data['game'][] = $row;
    }
}

$json_encoded_object = json_encode($data);

print($json_encoded_object);

?>