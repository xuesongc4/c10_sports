<?php

$output = [
    ['gameid' => '123', 'date' =>'2016-10-28 00:25:00','type'=>'moneyline', 'side'=>1,'home'=>'ten','away'=>'jax', 'odds' =>'-110'],
    ['gameid' => '124','date' =>'2016-10-30 13:30:00','type'=>'moneyline', 'side'=>1,'home'=>'cin','away'=>'was','odds' =>'-110'],
    ['gameid' => '125','date' =>'2016-10-30 20:25:00','type'=>'over/under', 'side'=>0,'home'=>'atl','away'=>'gb','odds' =>'-110'],
    ['gameid' => '126','date' =>'2016-10-30 20:05:00','type'=>'spread', 'side'=>0,'home'=>'dal','away'=>'phi','odds' =>'-110'],
    ['gameid' => '127','date' =>'2016-10-31 00:30:00','type'=>'spread', 'side'=>0,'home'=>'chi','away'=>'min','odds' =>'-110'],

];

$encoded_output = json_encode($output);
print($encoded_output);
?>