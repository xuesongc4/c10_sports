<?php
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 10/24/2016
 * Time: 6:39 PM
 */
date_default_timezone_set('America/New_York');
//print_r($_POST);

$json_encoded = json_encode($_POST);
$file_name = 'written_bets.php';

// Open the file to get existing content
$current = file_get_contents($file_name);
//strip the final brace to allow for more appended data
rtrim($current, "}");
// Append a new bet to the file
$current .= ','.$json_encoded.'}';
// Write the contents back to the file
file_put_contents($file_name, $current);

print_r($_POST);
?>