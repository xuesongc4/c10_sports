/**
 * Created by xueso on 10/24/2016.
 */


var app = angular.module('app', ['ngRoute','ngAnimate']);

app.factory("myFactory", function ($http, $q) {
    var data = {};

    data.getBetHistoryData = function (){
        var q = $q.defer();
        $http({
            url: 'retrieve_bet_history.php',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'post'
        })
            .then(function (response) {
                data.retrieve_bet_history = response.data;
                console.log("response in my factory: ", data);
                q.resolve(data.retrieve_bet_history);
            }, function () {
                console.log('error in getting data');
                q.reject('error in getting data')
            });
        return q.promise
    };

    data.getLeaderData = function (){
        var q = $q.defer();
        $http({
            url: 'retrieve_leaderboard_data.php',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'post'
        })
            .then(function (response) {
                data.leaderboard_data = response.data;
                console.log("response in my factory: ", data);
                q.resolve(data.leaderboard_data);
            }, function () {
                console.log('error in getting data');
                q.reject('error in getting data')
            });
        return q.promise
    };

    data.getData = function (data_to_send) {
        var q = $q.defer();
        $http({
            data:data_to_send,
            url: 'retrieve_game_data.php',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'post'
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
            url: 'add_bet_to_db.php',
            data: $.param(betData)
        })
    };
    return data;
});

app.controller('controller', function (myFactory) {

    var self = this;
    this.menu_toggle = true;
    this.gotData = false;
    this.bet_button_toggle=false;

    this.highlightDate=[false,'selected_date',false];
    this.show_circle_bet=[false,true,true];
    this.highlight = [];
    this.sendData = {};
    this.displayData = {};
    this.saveBetData = {};
    this.bet_index_mem=100;

    this.sendBetData = function () {
        self.bet_button_toggle=false;
        self.highlight = [];
        self.bet_index_mem=100;
        console.log('the bet data I am sending the server is: ', self.saveBetData);
        myFactory.sendData(self.saveBetData)
            .then(function (response) {
                console.log('bet succesfully sent: ', response);
                self.saveBetData = {};
                for (var i = 0; i < self.displayData.length; i++) {
                    self.displayData[i].bet_toggle = false;
                }
            }),
            function (response) {
                alert('error!');
            }
    };

    this.saveData = function (bet_index,index, type_of_bet, side, line, odds, select_index,side_name,line2) {
        if(self.bet_index_mem==bet_index){
            self.highlight=[];
            self.saveBetData={};
            self.bet_index_mem=100;
        }

        else{
            self.bet_index_mem=bet_index;
            self.saveBetData.game_id = index;
            self.saveBetData.side = side;
            self.saveBetData.type_of_bet = type_of_bet;
            self.saveBetData.line = line;
            self.saveBetData.line2 = line2;
            self.saveBetData.odds = odds;
            self.saveBetData.side_name = side_name;
            self.highlight = [];
            self.highlight[select_index] = 'selected';
            self.bet_button_toggle = true;
        }
    };
    this.betToggle = function (index) {
        self.bet_button_toggle=false;
        self.bet_index_mem=100;
        self.highlight = [];
        self.saveBetData = {};
        for (var i = 0; i < self.displayData.length; i++) {
            if (i != index) {
                self.displayData[i].bet_toggle = false;
            }
        }
        self.displayData[index].bet_toggle = !self.displayData[index].bet_toggle;
    };

    this.getGameData = function (date,league) {
        self.sendData.date = date;

        if(date=='previous'){
            this.highlightDate=['selected_date',false,false];
        }
        else if (date=='current'){
            this.highlightDate=[false,'selected_date',false];
        }
        else if(date=='future'){
            this.highlightDate=[false,false,'selected_date'];
        }

        if(league) {
            self.sendData.league = league;
        }
        console.log('the data I am sending the server is: ', self.sendData);

        myFactory.getData(self.sendData)
            .then(function (response) {
                    for (var i = 0; i < response.length; i++) {
                        response[i].bet_toggle = false;
                    };
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
        .when('/accountinfo', {
            templateUrl: 'pages/account_info.html',
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

app.controller('leaderboard', function (myFactory) {
    var self = this;
    this.leaderboard_data = null;
    this.get_leaderboard_data = function(){
        myFactory.getLeaderData()
            .then(function (response) {
                    self.leaderboard_data=response;
                console.log(self.leaderboard_data);
                },
                function (response) {
                    console('error!');
                });
    }
    this.get_leaderboard_data();
});

app.controller('bethistory', function (myFactory) {
    var self = this;
    this.bet_history = null;
    this.get_bet_history = function(){
        myFactory.getBetHistoryData()
            .then(function (response) {
                    self.bet_history=response;
                    console.log(self.bet_history);
                },
                function (response) {
                    console('error!');
                });
    }
    this.get_bet_history();
});
