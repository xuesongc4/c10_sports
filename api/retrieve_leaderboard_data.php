<?php

$output = [
    ['sn' => 'dood1', 'money' =>1000],
    ['sn' => 'dood2','money' =>1200],
    ['sn' => 'dood3','money' =>15],
    ['sn' => 'gal1','money' =>250],
    ['sn' => 'gal2','money' =>1125],
    ['sn' => 'gal3','money' =>50],
];

$encoded_output = json_encode($output);
print($encoded_output);
?>