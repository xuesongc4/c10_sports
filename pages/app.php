<!DOCTYPE html>
<html ng-app="app">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <title>iBet</title>
</head>
<body ng-controller="controller as ic">
<div class="container2">
    <img src="images/List.png" class="menu_button" ng-click="ic.menu_toggle=false; ic.addUsersFunds()">&nbsp</img>
        <div ng-cloak class="menu animate2" ng-hide="ic.menu_toggle">
            <div class="account_info">
                <br>
                <span style="margin-top: 100px; font-weight: bolder"> {{ic.user_funds.username}}</span>
                <div class="funds">Total Funds: <div style="display: inline-block"><span ng-if="ic.user_funds.funds < 0">-</span>${{ic.user_funds.funds_abs}}</div>
                </div>
                <div class="funds">Unsettled Bets: <div style="display: inline-block">${{ic.user_funds.funds_at_risk}}</div>
                </div>
                <div class="funds">To Win: <div style="display: inline-block">${{ic.user_funds.potential_winnings}}</div>
                </div>
            </div>
            <a class="menu_option_top" href="#/" ng-click="ic.menu_toggle=true; ic.getGameData()"><img
                    src="images/Football.png"></img> Game Screen</a>
            <a class="menu_option" href="#/bethistory" ng-click="ic.menu_toggle=true"><img
                    src="images/GraphBar.png"></img> Bet History</a>
            <a class="menu_option" href="#/leaderboard" ng-click="ic.menu_toggle=true"><img src="images/Trophy.png"></img>
                Leaderboard</a>
            <a class="menu_option" href="#/faq" ng-click="ic.menu_toggle=true"><img
                    src="images/Question.png"></img> FAQ</a>
            <a class="menu_option" href="#/aboutus" ng-click="ic.menu_toggle=true"><div class="logo_menu">iBet</div>
                About us</a>
            <a class="menu_option_logout" href="api/logout.php" ng-click="ic.menu_toggle=true"><img src="images/Exit.png"></img> Logout</a>
        </div>
        <div ng-cloak class="menu_close" ng-hide="ic.menu_toggle" ng-click="ic.menu_toggle=true"></div>
</div>
<div class="container" ng-view>
</div>
</body>
</html>