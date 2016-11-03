<?php 
require('../api_calls.php');
$stuff = odds_call(15,880);

echo "<pre>";
print_r($stuff);
echo "</pre>";

 ?>