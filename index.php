<?php
session_start();
$logged_in = false;
if (isset($_SESSION['username'])) {
    $logged_in = true;
}
if (!$logged_in) {
    // html page for not being logged in
    require('pages/client_login.php');
} else {
    // html page for being logged in
    require('pages/app.php');
}
 ?>

