/**
 * Created by xueso on 10/24/2016.
 */
var app = angular.module('app', ['ngRoute']);

app.factory("myFactory", function ($http, $q) {
    var data = {};
    data.getData = function () {
        var q = $q.defer();
        $http({
            url: 'dummy_data.php',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
            .then(function (response) {
                data.bet_data = response.data;
                console.log("response in my factory: ", data);
                q.resolve(data.bet_data);
            }, function () {
                console.log('error in getting data');
                q.reject('error in getting data')
            });
        return q.promise
    };

    data.sendData = function (betData) {
        return $http({
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'post',
            url: 'make_bet.php',
            data: $.param(betData)
        })
    };
    return data;
});

app.controller('controller', function (myFactory) {
    var self = this;
    this.menu_toggle = true;
    this.gotData = false;

    this.highlight = [];
    this.sendData = {};
    this.displayData = {};
    this.saveBetData = {};

    this.sendBetData = function () {
        self.highlight = [];
        console.log('the bet data I am sending the server is: ', self.saveBetData);
        myFactory.sendData(self.saveBetData)
            .then(function (response) {
                console.log('bet succesfully sent: ', response);
                self.saveBetData = {};
            }),
            function (response) {
                alert('error!');
            }
    };

    this.saveData = function (index, type_of_bet, side, spread, odds, select_index) {
        self.saveBetData.game_id = index;
        self.saveBetData.side = side;
        self.saveBetData.type_of_bet = type_of_bet;
        self.saveBetData.spread = spread;
        self.saveBetData.odds = odds;
        self.highlight = [];
        self.highlight[select_index] = 'selected';
    };
    this.betToggle = function (index) {
        self.highlight = [];
        for (var i = 0; i < self.displayData.length; i++) {
            if (i != index) {
                self.displayData[i].bet_toggle = false;
            }
        }
        self.displayData[index].bet_toggle = !self.displayData[index].bet_toggle;
    };

    this.getGameData = function (game) {
        self.sendData.date = game;
        console.log('the data I am sending the server is: ', self.sendData);

        myFactory.getData()
            .then(function (response) {
                    for (var i = 0; i < response.length; i++) {
                        response[i].bet_toggle = false;
                    }
                    ;
                    console.log("response with toggle information: ", response);
                    self.displayData = response;
                    self.gotData = true;
                },
                function (response) {
                    console('error!');
                });
    };
});

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'pages/home.html',
        })
        .when('/bethistory', {
            templateUrl: 'pages/bet_history.html',
        })
        .when('/leaderboard', {
            templateUrl: 'pages/leader_board.html',
        })
        .when('/stuffs', {
            templateUrl: 'pages/stuffs.html',
        })
        .when('/morestuffs', {
            templateUrl: 'pages/more_stuffs.html'
        })
        .otherwise({
            redirectTo: '/'
        });
});