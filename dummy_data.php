<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 10/18/2016
 * Time: 5:15 PM
 */

date_default_timezone_set('America/New_York');
//create dummy game data for week 7

//nfl teams
$nfl_teams = [
    ['ID'=>0,'long_name'=>'Arizona Cardinals','abbr_name'=>'ARI','logo_src'=>'images/ARI.png'],
    ['ID'=>1,'long_name'=>'Atlanta Falcons','abbr_name'=>'ATL','logo_src'=>'images/ATL.png'],
    ['ID'=>2,'long_name'=>'Baltimore Ravens','abbr_name'=>'BAL','logo_src'=>'images/BAL.png'],
    ['ID'=>3,'long_name'=>'Buffalo Bills','abbr_name'=>'BUF','logo_src'=>'images/BUF.png'],
    ['ID'=>4,'long_name'=>'Carolina Panthers','abbr_name'=>'CAR','logo_src'=>'images/CAR.png'],
    ['ID'=>5,'long_name'=>'Chicago Bears','abbr_name'=>'CHI','logo_src'=>'images/CHI.png'],
    ['ID'=>6,'long_name'=>'Cincinnati Bengals','abbr_name'=>'CIN','logo_src'=>'images/CIN.png'],
    ['ID'=>7,'long_name'=>'Cleveland Browns','abbr_name'=>'CLE','logo_src'=>'images/CLE.png'],
    ['ID'=>8,'long_name'=>'Dallas Cowboys','abbr_name'=>'DAL','logo_src'=>'images/DAL.png'],
    ['ID'=>9,'long_name'=>'Denver Broncos','abbr_name'=>'DEN','logo_src'=>'images/DEN.png'],
    ['ID'=>10,'long_name'=>'Detroit Lions','abbr_name'=>'DET','logo_src'=>'images/DET.png'],
    ['ID'=>11,'long_name'=>'Green Bay Packers','abbr_name'=>'GB','logo_src'=>'images/GB.png'],
    ['ID'=>12,'long_name'=>'Houston Texans','abbr_name'=>'HOU','logo_src'=>'images/HOU.png'],
    ['ID'=>13,'long_name'=>'Indianapolis Colts','abbr_name'=>'IND','logo_src'=>'images/IND.png'],
    ['ID'=>14,'long_name'=>'Jacksonville Jaguars','abbr_name'=>'JAX','logo_src'=>'images/JAX.png'],
    ['ID'=>15,'long_name'=>'Kansas City Chiefs','abbr_name'=>'KC','logo_src'=>'images/KC.png'],
    ['ID'=>16,'long_name'=>'Los Angeles Rams','abbr_name'=>'LA','logo_src'=>'images/LA.png'],
    ['ID'=>17,'long_name'=>'Miami Dolphins','abbr_name'=>'MIA','logo_src'=>'images/MIA.png'],
    ['ID'=>18,'long_name'=>'Minnesota Vikings','abbr_name'=>'MIN','logo_src'=>'images/MIN.png'],
    ['ID'=>19,'long_name'=>'New England Patriots','abbr_name'=>'NE','logo_src'=>'images/NE.png'],
    ['ID'=>20,'long_name'=>'New Orleans Saints','abbr_name'=>'NO','logo_src'=>'images/NO.png'],
    ['ID'=>21,'long_name'=>'New York Giants','abbr_name'=>'NYG','logo_src'=>'images/NYG.png'],
    ['ID'=>22,'long_name'=>'New York Jets','abbr_name'=>'NYJ','logo_src'=>'images/NYJ.png'],
    ['ID'=>23,'long_name'=>'Oakland Raiders','abbr_name'=>'OAK','logo_src'=>'images/OAK.png'],
    ['ID'=>24,'long_name'=>'Philadelphia Eagles','abbr_name'=>'PHI','logo_src'=>'images/PHI.png'],
    ['ID'=>25,'long_name'=>'Pittsburgh Steelers','abbr_name'=>'PIT','logo_src'=>'images/PIT.png'],
    ['ID'=>26,'long_name'=>'San Diego Chargers','abbr_name'=>'SD','logo_src'=>'images/SD.png'],
    ['ID'=>27,'long_name'=>'San Francisco 49ers','abbr_name'=>'SEA','logo_src'=>'images/SEA.png'],
    ['ID'=>28,'long_name'=>'Seattle Seahawks','abbr_name'=>'SF','logo_src'=>'images/SF.png'],
    ['ID'=>29,'long_name'=>'Tampa Bay Buccaneers','abbr_name'=>'TB','logo_src'=>'images/TB.png'],
    ['ID'=>30,'long_name'=>'Tennessee Titans','abbr_name'=>'TEN ','logo_src'=>'images/TEN .png'],
    ['ID'=>31,'long_name'=>'Washington Redskins','abbr_name'=>'WAS','logo_src'=>'images/WAS.png']
];

//game id => 1
//away team => id of chicago
//home team => id of green bay
//date => 2016-10-20-0825pm in easter time

//money line => [350,-450]
//over under => 47
//favorite => [10,-10]

$nfl_games_2016 = [
    ['ID'=>0, 'away'=>5, 'home'=>11 , 'date'=>'2016-10-20 20:25', 'money_line'=>[350,-450], 'over_under'=>[47,-110,-110], 'spread'=>[10,-10,-110,-110]],
    ['ID'=>1, 'away'=>21, 'home'=>16 , 'date'=>'2016-10-23 09:30', 'money_line'=>[-150,130], 'over_under'=>[44.5,-110,-110], 'spread'=>[-2,2,-110,-110]],
    ['ID'=>2, 'away'=>18, 'home'=>24 , 'date'=>'2016-10-23 13:00', 'money_line'=>[-140,120], 'over_under'=>[40,-110,-110], 'spread'=>[1.5,-1.5,-110,-110]],
    ['ID'=>3, 'away'=>20, 'home'=>15 , 'date'=>'2016-10-23 13:00', 'money_line'=>[255,-310], 'over_under'=>[49,-110,-110], 'spread'=>[7,-7,-110,-110]],
    ['ID'=>4, 'away'=>31, 'home'=>10 , 'date'=>'2016-10-23 13:00', 'money_line'=>[-105,-115], 'over_under'=>[51,-110,-110], 'spread'=>[1,-1,-110,-110]]
];

$output = [];

for($GAME_NUMBER  = 0; $GAME_NUMBER < count($nfl_games_2016); $GAME_NUMBER ++){
    $temp = [
        'away_long'=>$nfl_teams[ $nfl_games_2016[$GAME_NUMBER]['away'] ]['long_name'],
        'away_abbr'=>$nfl_teams[ $nfl_games_2016[$GAME_NUMBER]['away'] ]['abbr_name'],
        'away_pic'=>$nfl_teams[ $nfl_games_2016[$GAME_NUMBER]['away'] ]['logo_src'],
        'home_long'=>$nfl_teams[ $nfl_games_2016[$GAME_NUMBER]['home'] ]['long_name'],
        'home_abbr'=>$nfl_teams[ $nfl_games_2016[$GAME_NUMBER]['home'] ]['abbr_name'],
        'home_pic'=>$nfl_teams[ $nfl_games_2016[$GAME_NUMBER]['home'] ]['logo_src'],
        'date'=>$nfl_games_2016[$GAME_NUMBER]['date'],
        'money_line'=>$nfl_games_2016[$GAME_NUMBER]['money_line'],
        'over_under'=>$nfl_games_2016[$GAME_NUMBER]['over_under'],
        'favorite'=>$nfl_games_2016[$GAME_NUMBER]['spread']
    ];
    array_push($output, $temp);
}

$encoded_output = json_encode($output);
print($encoded_output);