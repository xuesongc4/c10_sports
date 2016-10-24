<?php
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 10/21/2016
 * Time: 5:22 PM
 */

include 'check_wins.js';

$jsonFull = '[{"id":651565924,"spread":{"homeSpread":-7.5,"homeOdds":-109,"awayOdds":-101},"moneyline":{"home":-340,"away":297},"total":{"points":40.5,"over":-107,"under":-103},"starts":"2016-10-25T00:30:00Z","home":"Denver Broncos","away":"Houston Texans"},{"id":651564122,"spread":{"homeSpread":-1,"homeOdds":-104,"awayOdds":-106},"moneyline":{"home":-110,"away":-100},"total":{"points":43.5,"over":-110,"under":100},"starts":"2016-10-24T00:30:00Z","home":"Arizona Cardinals","away":"Seattle Seahawks"},{"id":651564935,"spread":{"homeSpread":3,"homeOdds":-117,"awayOdds":106},"moneyline":{"home":127,"away":-140},"total":{"points":44.5,"over":-102,"under":-108},"starts":"2016-10-23T13:30:00Z","home":"Los Angeles Rams (n)","away":"New York Giants"},{"id":651563911,"spread":{"homeSpread":-10.5,"homeOdds":100,"awayOdds":-110},"moneyline":{"home":-475,"away":404},"total":{"points":44.5,"over":-105,"under":-105},"starts":"2016-10-23T17:00:00Z","home":"Cincinnati Bengals","away":"Cleveland Browns"},{"id":651564103,"spread":{"homeSpread":7,"homeOdds":-106,"awayOdds":-104},"moneyline":{"home":252,"away":-285},"total":{"points":48,"over":100,"under":-110},"starts":"2016-10-23T20:25:00Z","home":"Pittsburgh Steelers","away":"New England Patriots"},{"id":651564069,"spread":{"homeSpread":1,"homeOdds":-113,"awayOdds":102},"moneyline":{"home":-105,"away":-105},"total":{"points":45,"over":-105,"under":-105},"starts":"2016-10-23T20:05:00Z","home":"San Francisco 49ers","away":"Tampa Bay Buccaneers"},{"id":635491692,"spread":[],"moneyline":{"home":-105,"away":-105},"total":[],"starts":"2017-01-01T03:21:00Z","home":"Will Be available for all games","away":"2nd Half Wagering"},{"id":651564035,"spread":{"homeSpread":-6.5,"homeOdds":100,"awayOdds":-110},"moneyline":{"home":-230,"away":205},"total":{"points":54,"over":-109,"under":-101},"starts":"2016-10-23T20:05:00Z","home":"Atlanta Falcons","away":"San Diego Chargers"},{"id":651563838,"spread":{"homeSpread":3,"homeOdds":-105,"awayOdds":-105},"moneyline":{"home":140,"away":-155},"total":{"points":40,"over":-105,"under":-105},"starts":"2016-10-23T17:00:00Z","home":"Philadelphia Eagles","away":"Minnesota Vikings"},{"id":651563864,"spread":{"homeSpread":-6,"homeOdds":100,"awayOdds":-110},"moneyline":{"home":-235,"away":210},"total":{"points":51,"over":-108,"under":-102},"starts":"2016-10-23T17:00:00Z","home":"Kansas City Chiefs","away":"New Orleans Saints"},{"id":651563887,"spread":{"homeSpread":-1,"homeOdds":-107,"awayOdds":-103},"moneyline":{"home":-115,"away":104},"total":{"points":49.5,"over":-104,"under":-106},"starts":"2016-10-23T17:00:00Z","home":"Detroit Lions","away":"Washington Redskins"},{"id":651564013,"spread":{"homeSpread":-2,"homeOdds":-105,"awayOdds":-105},"moneyline":{"home":-123,"away":111},"total":{"points":41,"over":-105,"under":-105},"starts":"2016-10-23T17:00:00Z","home":"New York Jets","away":"Baltimore Ravens"},{"id":651563976,"spread":{"homeSpread":-3,"homeOdds":-119,"awayOdds":108},"moneyline":{"home":-165,"away":149},"total":{"points":47.5,"over":-105,"under":-105},"starts":"2016-10-23T17:00:00Z","home":"Tennessee Titans","away":"Indianapolis Colts"},{"id":651563925,"spread":{"homeSpread":2.5,"homeOdds":102,"awayOdds":-113},"moneyline":{"home":125,"away":-138},"total":{"points":44,"over":-108,"under":-102},"starts":"2016-10-23T17:00:00Z","home":"Miami Dolphins","away":"Buffalo Bills"},{"id":651563945,"spread":{"homeSpread":-1.5,"homeOdds":-105,"awayOdds":-105},"moneyline":{"home":-117,"away":106},"total":{"points":47.5,"over":-105,"under":-105},"starts":"2016-10-23T17:00:00Z","home":"Jacksonville Jaguars","away":"Oakland Raiders"}]';
$assoc_array = json_decode($jsonFull);


$dummy_data = 'Array ( [0] => stdClass Object ( [id] => 651565924 [spread] => stdClass Object ( [homeSpread] => -7.5 [homeOdds] => -109 [awayOdds] => -101 ) [moneyline] => stdClass Object ( [home] => -340 [away] => 297 ) [total] => stdClass Object ( [points] => 40.5 [over] => -107 [under] => -103 ) [starts] => 2016-10-25T00:30:00Z [home] => Denver Broncos [away] => Houston Texans ) [1] => stdClass Object ( [id] => 651564122 [spread] => stdClass Object ( [homeSpread] => -1 [homeOdds] => -104 [awayOdds] => -106 ) [moneyline] => stdClass Object ( [home] => -110 [away] => -100 ) [total] => stdClass Object ( [points] => 43.5 [over] => -110 [under] => 100 ) [starts] => 2016-10-24T00:30:00Z [home] => Arizona Cardinals [away] => Seattle Seahawks ) [2] => stdClass Object ( [id] => 651564935 [spread] => stdClass Object ( [homeSpread] => 3 [homeOdds] => -117 [awayOdds] => 106 ) [moneyline] => stdClass Object ( [home] => 127 [away] => -140 ) [total] => stdClass Object ( [points] => 44.5 [over] => -102 [under] => -108 ) [starts] => 2016-10-23T13:30:00Z [home] => Los Angeles Rams (n) [away] => New York Giants ) [3] => stdClass Object ( [id] => 651563911 [spread] => stdClass Object ( [homeSpread] => -10.5 [homeOdds] => 100 [awayOdds] => -110 ) [moneyline] => stdClass Object ( [home] => -475 [away] => 404 ) [total] => stdClass Object ( [points] => 44.5 [over] => -105 [under] => -105 ) [starts] => 2016-10-23T17:00:00Z [home] => Cincinnati Bengals [away] => Cleveland Browns ) [4] => stdClass Object ( [id] => 651564103 [spread] => stdClass Object ( [homeSpread] => 7 [homeOdds] => -106 [awayOdds] => -104 ) [moneyline] => stdClass Object ( [home] => 252 [away] => -285 ) [total] => stdClass Object ( [points] => 48 [over] => 100 [under] => -110 ) [starts] => 2016-10-23T20:25:00Z [home] => Pittsburgh Steelers [away] => New England Patriots ) [5] => stdClass Object ( [id] => 651564069 [spread] => stdClass Object ( [homeSpread] => 1 [homeOdds] => -113 [awayOdds] => 102 ) [moneyline] => stdClass Object ( [home] => -105 [away] => -105 ) [total] => stdClass Object ( [points] => 45 [over] => -105 [under] => -105 ) [starts] => 2016-10-23T20:05:00Z [home] => San Francisco 49ers [away] => Tampa Bay Buccaneers ) [6] => stdClass Object ( [id] => 635491692 [spread] => Array ( ) [moneyline] => stdClass Object ( [home] => -105 [away] => -105 ) [total] => Array ( ) [starts] => 2017-01-01T03:21:00Z [home] => Will Be available for all games [away] => 2nd Half Wagering ) [7] => stdClass Object ( [id] => 651564035 [spread] => stdClass Object ( [homeSpread] => -6.5 [homeOdds] => 100 [awayOdds] => -110 ) [moneyline] => stdClass Object ( [home] => -230 [away] => 205 ) [total] => stdClass Object ( [points] => 54 [over] => -109 [under] => -101 ) [starts] => 2016-10-23T20:05:00Z [home] => Atlanta Falcons [away] => San Diego Chargers ) [8] => stdClass Object ( [id] => 651563838 [spread] => stdClass Object ( [homeSpread] => 3 [homeOdds] => -105 [awayOdds] => -105 ) [moneyline] => stdClass Object ( [home] => 140 [away] => -155 ) [total] => stdClass Object ( [points] => 40 [over] => -105 [under] => -105 ) [starts] => 2016-10-23T17:00:00Z [home] => Philadelphia Eagles [away] => Minnesota Vikings ) [9] => stdClass Object ( [id] => 651563864 [spread] => stdClass Object ( [homeSpread] => -6 [homeOdds] => 100 [awayOdds] => -110 ) [moneyline] => stdClass Object ( [home] => -235 [away] => 210 ) [total] => stdClass Object ( [points] => 51 [over] => -108 [under] => -102 ) [starts] => 2016-10-23T17:00:00Z [home] => Kansas City Chiefs [away] => New Orleans Saints ) [10] => stdClass Object ( [id] => 651563887 [spread] => stdClass Object ( [homeSpread] => -1 [homeOdds] => -107 [awayOdds] => -103 ) [moneyline] => stdClass Object ( [home] => -115 [away] => 104 ) [total] => stdClass Object ( [points] => 49.5 [over] => -104 [under] => -106 ) [starts] => 2016-10-23T17:00:00Z [home] => Detroit Lions [away] => Washington Redskins ) [11] => stdClass Object ( [id] => 651564013 [spread] => stdClass Object ( [homeSpread] => -2 [homeOdds] => -105 [awayOdds] => -105 ) [moneyline] => stdClass Object ( [home] => -123 [away] => 111 ) [total] => stdClass Object ( [points] => 41 [over] => -105 [under] => -105 ) [starts] => 2016-10-23T17:00:00Z [home] => New York Jets [away] => Baltimore Ravens ) [12] => stdClass Object ( [id] => 651563976 [spread] => stdClass Object ( [homeSpread] => -3 [homeOdds] => -119 [awayOdds] => 108 ) [moneyline] => stdClass Object ( [home] => -165 [away] => 149 ) [total] => stdClass Object ( [points] => 47.5 [over] => -105 [under] => -105 ) [starts] => 2016-10-23T17:00:00Z [home] => Tennessee Titans [away] => Indianapolis Colts ) [13] => stdClass Object ( [id] => 651563925 [spread] => stdClass Object ( [homeSpread] => 2.5 [homeOdds] => 102 [awayOdds] => -113 ) [moneyline] => stdClass Object ( [home] => 125 [away] => -138 ) [total] => stdClass Object ( [points] => 44 [over] => -108 [under] => -102 ) [starts] => 2016-10-23T17:00:00Z [home] => Miami Dolphins [away] => Buffalo Bills ) [14] => stdClass Object ( [id] => 651563945 [spread] => stdClass Object ( [homeSpread] => -1.5 [homeOdds] => -105 [awayOdds] => -105 ) [moneyline] => stdClass Object ( [home] => -117 [away] => 106 ) [total] => stdClass Object ( [points] => 47.5 [over] => -105 [under] => -105 ) [starts] => 2016-10-23T17:00:00Z [home] => Jacksonville Jaguars [away] => Oakland Raiders ) )';
$small_dummy_data = 'Array ([0] => stdClass Object ( [id] => 651565924 [spread] => stdClass Object ( [homeSpread] => -7.5 [homeOdds] => -109 [awayOdds] => -101 ) [moneyline] => stdClass Object ( [home] => -340 [away] => 297 ) [total] => stdClass Object ( [points] => 40.5 [over] => -107 [under] => -103 ) [starts] => 2016-10-25T00:30:00Z [home] => Denver Broncos [away] => Houston Texans ) [1] => stdClass Object ( [id] => 651564122 [spread] => stdClass Object ( [homeSpread] => -1 [homeOdds] => -104 [awayOdds] => -106 ) [moneyline] => stdClass Object ( [home] => -110 [away] => -100 ) [total] => stdClass Object ( [points] => 43.5 [over] => -110 [under] => 100 ) [starts] => 2016-10-24T00:30:00Z [home] => Arizona Cardinals [away] => Seattle Seahawks ) [2] => stdClass Object ( [id] => 651564935 [spread] => stdClass Object ( [homeSpread] => 3 [homeOdds] => -117 [awayOdds] => 106 ) [moneyline] => stdClass Object ( [home] => 127 [away] => -140 ) [total] => stdClass Object ( [points] => 44.5 [over] => -102 [under] => -108 ) [starts] => 2016-10-23T13:30:00Z [home] => Los Angeles Rams (n) [away] => New York Giants ) [3] => stdClass Object ( [id] => 651563911 [spread] => stdClass Object ( [homeSpread] => -10.5 [homeOdds] => 100 [awayOdds] => -110 ) [moneyline] => stdClass Object ( [home] => -475 [away] => 404 ) [total] => stdClass Object ( [points] => 44.5 [over] => -105 [under] => -105 ) [starts] => 2016-10-23T17:00:00Z [home] => Cincinnati Bengals [away] => Cleveland Browns ) [4] => stdClass Object ( [id] => 651564103 [spread] => stdClass Object ( [homeSpread] => 7 [homeOdds] => -106 [awayOdds] => -104 ) [moneyline] => stdClass Object ( [home] => 252 [away] => -285 ) [total] => stdClass Object ( [points] => 48 [over] => 100 [under] => -110 ) [starts] => 2016-10-23T20:25:00Z [home] => Pittsburgh Steelers [away] => New England Patriots ) [5] => stdClass Object ( [id] => 651564069 [spread] => stdClass Object ( [homeSpread] => 1 [homeOdds] => -113 [awayOdds] => 102 ) [moneyline] => stdClass Object ( [home] => -105 [away] => -105 ) [total] => stdClass Object ( [points] => 45 [over] => -105 [under] => -105 ) [starts] => 2016-10-23T20:05:00Z [home] => San Francisco 49ers [away] => Tampa Bay Buccaneers ) )';

$json_encoded = json_encode($small_dummy_data);

$dummy_bets = "[['ID'=>'1', 'type_of_bet'=>'over_under', 'side'=>'true', 'odds'=>'-107', 'line'=>'40.5'], ['ID'=>'2', 'type_of_bet'=>'over_under', 'side'=>'under', 'odds'=>'-103', 'line'=>'40.5'], ['ID'=>'3', 'type_of_bet'=>'money_line', 'side'=>'true', 'odds'=>'-330']]";

?>
<!--<script>check_wins()</script>-->
$check_winner = <script>check_wins(1,'34-17', <?php $dummy_bets[1]['type_of_bet']?>, <?php $dummy_bets[1]['side']?>, <?php $dummy_bets[1]['odds']?>, <?php $dummy_bets[1]['line']?> )</script>;
$check_winner = check_wins(1,'34-17', <?php $dummy_bets[1]['type_of_bet']?>, <?php $dummy_bets[1]['side']?>, <?php $dummy_bets[1]['odds']?>, <?php $dummy_bets[1]['line']?> );

print($check_winner);
<!--echo "<pre>";-->
<!--print_r($json_encoded);-->
<!--echo "</pre>";-->
?>
