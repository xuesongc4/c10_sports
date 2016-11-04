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
    <img src="images/List.png" class="menu_button" ng-click="ic.menu_toggle=false; ic.addUsersFunds()">&nbsp</img>
    <div class="league_button_bold"><img class = 'logo' src="images/ibet.jpg"></div>
    <div class="whole_menu" ng-hide="ic.menu_toggle" ng-cloak>
        <div class="menu">
            <a class="menu_option account_info" href="#/accountinfo" ng-click="ic.menu_toggle=true">
             <br><span style="margin-top: 100px"> {{ic.user_funds.username}}JoeBab</span>
                <div class="funds">Current Funds:${{ic.user_funds.funds}}</span></div>
            </a>
            <a class="menu_option" href="#/" ng-click="ic.menu_toggle=true" style="border-top:solid black 2px "><img
                    src="images/Football.png"></img> Game Screen</a>
            <a class="menu_option" href="#/bethistory" ng-click="ic.menu_toggle=true"><img
                    src="images/GraphBar.png"></img> Bet History</a>
            <a class="menu_option" href="#/leaderboard" ng-click="ic.menu_toggle=true"><img src="images/Trophy.png"></img>
                Leader Board</a>
            <a class="menu_option" href="#/faq" ng-click="ic.menu_toggle=true"><img
                    src="images/Question.png"></img> FAQ</a>
            <a class="menu_option" href="#/aboutus" ng-click="ic.menu_toggle=true"><img src="images/Question.png"></img>
                About us</a>
            <a class="menu_option_logout" href="api/logout.php" ng-click="ic.menu_toggle=true"><img src="images/Exit.png"></img> Logout</a>
        </div>
        <div class="menu_close" ng-click="ic.menu_toggle=true"></div>
    </div>
</div>
<div class="container" ng-view>
</div>
</body>
</html>