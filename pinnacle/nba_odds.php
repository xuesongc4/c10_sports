<?php
$connection = mysqli_connect('localhost', 'root', '', 'betting');

require('api_calls.php');
$stuff = odds_call(4,487);

echo "<pre>";
print_r($stuff);
echo "</pre>";
 ?>