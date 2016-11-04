<?php 
require('../api_calls.php');
$stuff = odds_call(3,246);

echo "<pre>";
print_r($stuff);
echo "</pre>";

 ?>