<?php
date_default_timezone_set('UTC');
require('constants.php');
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(isset($_POST['username'])){
    $searched_user = $_POST['username'];
}

//$searched_user = "second_guy";
//$searched_user = "bob";
//$searched_user = "billybob";       //for testing (no such user)

//$user = 1;  //temp while no users are defined             //i think this line can be removed

//currently username is aliased as 'sn' to accomodate Jason's angular naming conventions
//$leaderboard_query = "SELECT u.username AS sn, ROUND(SUM(t.transaction),2) AS money FROM `transactions` AS t JOIN `users` AS u ON u.ID = t.user_id GROUP BY t.user_id ORDER BY money DESC LIMIT 10";
$leaderboard_query = "SELECT u.username, ROUND(SUM(t.transaction),2) AS money FROM `transactions` AS t JOIN `users` AS u ON u.ID = t.user_id GROUP BY u.ID ORDER BY money DESC";
$leaderboard_results = mysqli_query($connection, $leaderboard_query);

$leaderboard = [];
$data = [];
if(mysqli_num_rows($leaderboard_results)){
    while ($row = mysqli_fetch_assoc($leaderboard_results)) {
        $leaderboard[] = $row;
    }

    if (isset($searched_user)) {
        //if we are searching for a specific user
        //search for the user in the leaderboard
        for($index = 0; $index < count($leaderboard); $index++){
            if ($leaderboard[$index]['username'] === $searched_user) {
                //if the user has been found, store the key
                $user_key = $index;
                break;
            }
        }

        if (isset($user_key)) {
            //if a user is being searched for
            $data['leaderboard_count'] = count($leaderboard);
            $data['user_key'] = $user_key;
            //if the user was found
            if($user_key < 10){
                //if the found user is already in top ten
                for($index = 0; $index < 10; $index++){
                    $curr_user = [
                        'place' => $index + 1,
                        'sn' => $leaderboard[$index]['username'],
                        'money' => $leaderboard[$index]['money']
                    ];
                    $data['leaderboard_info'][] = $curr_user;
                }
            }else if($user_key > count($leaderboard) - 10){
                //if the found user is in the bottom ten
               // echo 'im in the right place for second_guy';
                for($index = count($leaderboard) - 10; $index < count($leaderboard); $index++){
                    $curr_user = [
                        'place' => $index + 1,
                        'sn' => $leaderboard[$index]['username'],
                        'money' => $leaderboard[$index]['money']
                    ];
                    $data['leaderboard_info'][] = $curr_user;
                }
            }else{
               // echo 'i should not be here';
                //else the found user is outside of the top ten
                for($index = $user_key - 4; $index <= $user_key + 6; $index++){
                    $curr_user = [
                        'place' => $index + 1,
                        'sn' => $leaderboard[$index]['username'],
                        'money' => $leaderboard[$index]['money']
                    ];
                    $data['leaderboard_info'][] = $curr_user;
                }
            }
        }else{
            //else the user was not found
            $data['errors'][] = 'user not found';
            //store the top 10 entries of the leaderboard
            for($index = 0; $index < 10; $index++){
                $curr_user = [
                    'place' => $index + 1,
                    'sn' => $leaderboard[$index]['username'],
                    'money' => $leaderboard[$index]['money']
                ];
                $data['leaderboard_info'][] = $curr_user;
            }
        }
    }else{
        //else we are not searching for a specific user
        //store the top 10 entries of the leaderboard
        for($index = 0; $index < 10; $index++){
            $curr_user = [
                'place' => $index + 1,
                'sn' => $leaderboard[$index]['username'],
                'money' => $leaderboard[$index]['money']
            ];
            $data['leaderboard_info'][] = $curr_user;
        }
    }


}else{
    $data['errors'][] = 'no leaderboard data available';
}

//remember to alias username to sn because of Jason's angular naming conventions

////for testing
//print('<pre>');
//print_r($data);
//print('</pre>');

$encoded_output = json_encode($data);
print($encoded_output);

//***************** old ***********************
//
//$output = [
//    ['sn' => 'dood1', 'money' =>1000],
//    ['sn' => 'dood2','money' =>1200],
//    ['sn' => 'dood3','money' =>15],
//    ['sn' => 'gal1','money' =>250],
//    ['sn' => 'gal2','money' =>1125],
//    ['sn' => 'gal3','money' =>50],
//];
//
//$encoded_output = json_encode($output);
//print($encoded_output);
?>