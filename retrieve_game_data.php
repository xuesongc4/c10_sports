<?php
require_once('mysql_connect.php');
date_default_timezone_set('UTC');

$away_team_info_query = "SELECT t.full_name, t.abbr_name, t.logo_src FROM `teams` AS t JOIN `games` AS g ON g.team_h_id = t.ID WHERE g.league_id = 1";
$home_team_info_query = "SELECT t.full_name, t.abbr_name, t.logo_src FROM `teams` AS t JOIN `games` AS g ON g.team_h_id = t.ID WHERE g.league_id = 1";
?>