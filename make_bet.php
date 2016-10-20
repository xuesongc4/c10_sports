<?php
session_start();
/**
* Created by PhpStorm.
* User: Kyle
* Date: 10/18/2016
* Time: 5:15 PM
*/

date_default_timezone_set('America/New_York');


$output = $_POST;

$encoded_output = json_encode($output);
print($encoded_output);

?>