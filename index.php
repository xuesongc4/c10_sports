<?php
session_start();
$logged_in = false;
if (isset($_SESSION['username'])) {
    $logged_in = true;
}
if (!$logged_in) {
    // html page for not being logged in
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link href="https://fonts.googleapis.com/css?family=Concert+One|Khand|Roboto+Condensed" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>
    <video class="video" autoplay loop>
        <source src="video/blurred.mp4" type="video/mp4"/>
        Your browser does not support HTML5 video.
    </video>
    <div class="login_background"></div>
    <div class="form">
        <div class="header">
            iBet
        </div>
        <div class="header2 loader2"></div>
        <form action="api/login.php" method="post">
                <input class="input" type="text" name="username" placeholder="Username"><br>
                <input class="input" type="password" name="password" placeholder="Password"><br>
            <button class="user_login" name="login">Login</button>
        </form>
    </div>
    <script>
        $('.user_login').on('click',function(){
            $('.header2').css('display','initial');
        });
    </script>
    <script>
        localStorage.removeItem('bet_user_id');
    </script>
    </body>
    </html>
    <?php
    // html page for being logged in
} else {
    ?>


    <!DOCTYPE html>
    <html ng-app="app">
    <head>
        <meta charset="UTF-8">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.js"></script>
        <script src="http://code.angularjs.org/1.4.8/angular-route.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Concert+One|Khand|Roboto+Condensed" rel="stylesheet">
        <script src="script_angular.js"></script>
        <script>
            localStorage.setItem('bet_user_id', "<?php echo $_SESSION['ID']; ?>");
        </script>
        <title>Gambling app</title>
    </head>
    <body ng-controller="controller as ic">
    <div class="container2">
        <img src="images/List.png" class="menu_button" ng-click="ic.menu_toggle=false; ic.addUsersFunds">&nbsp</img>
        <div class="whole_menu" ng-hide="ic.menu_toggle" ng-cloak>
            <div class="menu">
                <a class="menu_option account_info" href="#/accountinfo" ng-click="ic.menu_toggle=true"><img
                        src="images/User.png"></img> {{ic.user_funds.username}}
                    <div class="funds">Current Funds: <span style="color:red; font-weight: bold">${{ic.user_funds.funds}}</span></div>
                </a>
                <a class="menu_option" href="#/" ng-click="ic.menu_toggle=true"><img
                        src="images/Football.png"></img> Game Screen</a>
                <a class="menu_option" href="#/bethistory" ng-click="ic.menu_toggle=true"><img
                        src="images/GraphBar.png"></img> Bet History</a>
                <a class="menu_option" href="#/leaderboard" ng-click="ic.menu_toggle=true"><img src="images/Trophy.png"></img>
                    Leader Board</a>
                <a class="menu_option" href="#/faq" ng-click="ic.menu_toggle=true"><img
                        src="images/Question.png"></img> FAQ</a>
                <a class="menu_option" href="#/aboutus" ng-click="ic.menu_toggle=true"><img src="images/Question.png"></img>
                    About us</a>
                <a class="menu_option" href="api/logout.php" ng-click="ic.menu_toggle=true"><img src="images/Exit.png"></img> Logout</a>
            </div>
            <div class="menu_close" ng-click="ic.menu_toggle=true"></div>
        </div>
    </div>
    <div class="container" ng-view>
    </div>
    </body>
    </html>

    <?php
}
?>
