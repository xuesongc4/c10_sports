<?php
require('../mysql_connect.php');
$select_query = "SELECT * FROM teams";
$result = mysqli_query($connection, $select_query);
$teams = [];
while($row = mysqli_fetch_assoc($result)) {
    $teams[] = $row;
}

foreach($teams as $team) {
    if ($team['league_id'] == 889) {
        $league = 'NFL';
    } else if ($team['league_id'] == 487) {
        $league = 'NBA';
    } else {
        $league = 'MLB';
    }

    $logo_src = 'images/' . $league . '/' . $team['abbr_name'] . '.jpg';

    $update_query = "UPDATE teams SET logo_src = '{$logo_src}' WHERE full_name = '{$team['full_name']}'";

    mysqli_query($connection, $update_query);
}
?>