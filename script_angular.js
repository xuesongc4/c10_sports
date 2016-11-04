/**
 * Created by xueso on 10/24/2016.
 */


var app = angular.module('app', ['ngRoute','ngAnimate']);

app.factory("myFactory", function ($http, $q) {
    var data = {};
    data.findUsersFunds = function(){
        var q = $q.defer();
        $http({
            url: 'api/find_users_funds.php',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'post'
        })
            .then(function (response) {
                data.find_users_funds = response.data;
                console.log("funds data in my factory: ", data);
                q.resolve(data.find_users_funds);
            }, function () {
                console.log('error in getting data');
                q.reject('error in getting data')
            });
        return q.promise;
        };

    data.getBetHistoryData = function (){
        var q = $q.defer();
        $http({
            url: 'api/retrieve_bet_history.php',
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
                q.reject('error in getting data')
            });
        return q.promise
    };

    data.getLeaderData = function (){
        var q = $q.defer();
        $http({
            url: 'api/retrieve_leaderboard_data.php',
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
            data: $.param(data_to_send),
            url: 'api/retrieve_game_data.php',
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
            url: 'api/add_bet_to_db.php',
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
    this.show_circle_bet=[true,true,true];
    this.highlight = [];
    this.sendData = {};
    this.displayData = {};
    this.saveBetData = {};
    this.bet_index_mem=100;
    this.league_highlight=[0,0,0,0,0,0];
    this.user_funds={};

    this.addUsersFunds = function(){
        console.log('adding user funds');
        myFactory.findUsersFunds()
            .then(function (response) {
                self.user_funds = response;
                console.log("myfunds reponse: ",response);

                }),
                 function (response) {
                alert('error!');
            }
    };
    self.addUsersFunds();


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
        $('.loader').removeClass('hide');
        $('.loader_background').removeClass('hide');
        if(date=='previous'){
            this.highlightDate=['selected_date',false,false];
        }
        else if (date=='current'){
            this.highlightDate=[false,'selected_date',false];
        }
        else if(date=='future'){
            this.highlightDate=[false,false,'selected_date'];
        }

        switch (league) {
            case 'NFL':
                self.league_highlight = ['sel',0,0,0,0,0];
                break;
            case 'NBA':
                self.league_highlight = [0,'sel',0,0,0,0];
                break;
            case 'MLB':
                self.league_highlight = [0,0,'sel',0,0,0];
                break;
            case 'NHL':
                self.league_highlight = [0,0,0,'sel',0,0];
                break;
            case 'NCAAF':
                self.league_highlight = [0,0,0,0,'sel',0];
                break;
            case 'NCAAB':
                self.league_highlight = [0,0,0,0,0,'sel'];
                break;
        }

        self.sendData.game_block = date;
//--------------------DATE GETTER needs to be converted to normal time not utc----------------------------------------------------
        var date = new Date();
        date.setHours(0);
        var tomorrow_milli = date.getTime()+86400000;
        var dateNext = new Date(tomorrow_milli);
        var utcMonth2 = dateNext.getUTCMonth()+1;
        var utcDate2 = dateNext.getUTCDate();
        var utcYear2 = dateNext.getUTCFullYear();
        var utcHour2 = dateNext.getUTCHours();
        var utcMonth1 = date.getUTCMonth()+1;
        var utcDate1 = date.getUTCDate();
        var utcYear1 = date.getUTCFullYear();
        var utcHour1 = date.getUTCHours();
        if (utcMonth1 < 10) {
          utcMonth1 = '' + '0' + utcMonth1;
        }
        if (utcMonth2 < 10) {
          utcMonth2 = '' + '0' + utcMonth2;
        }
        if (utcDate1 < 10) {
          utcDate1 = '' + '0' + utcDate1;
        }
        if (utcDate2 < 10) {
          utcDate2 = '' + '0' + utcDate2;
        }
        if (utcHour1 < 10) {
          utcHour1 = '' + '0' + utcHour1;
        }
        if (utcHour2 < 10) {
          utcHour2 = '' + '0' + utcHour2;
        }
        var utcMyDatePrev=utcYear1+"-"+utcMonth1+"-"+utcDate1 + " " + utcHour1;
        var utcMyDateNext=utcYear2+"-"+utcMonth2+"-"+utcDate2 + " " + utcHour2;
        var utcMidnights = {
          startDay:utcMyDatePrev+":00:00",
          endDay:utcMyDateNext+":00:00"
        }
        self.sendData.start_end = utcMidnights;
        console.log('sending including start / end dates: ',self.sendData);

        if(league) {
            self.sendData.league = league;
        }
   //     console.log('the data I am sending the server is: ', self.sendData);
   // var offset = new Date().getTimezoneOffset();
        myFactory.getData(self.sendData)
            .then(function (response) {
                    for (var i = 0; i < response.length; i++) {
                        response[i].bet_toggle = false;
                        var date = new Date(response[i].game_time+' UTC');
                        var temp_date=date.toString().slice(0,15);
                        var temp_time=date.toString().slice(16,21);
                        var time_check = temp_time.slice(0,2);
                        var time_check2 = temp_time.slice(3,5);
                        if(time_check >= 12) {
                            temp_time = time_check - 12 + ':' + time_check2 + ' PM';
                        }
                        else{
                            temp_time = time_check -0 +':' + time_check2 +' AM';
                        }
                        response[i].game_time = temp_time;
                        response[i].game_date = temp_date;
                    };
                    console.log("response with toggle information: ", response);
                    self.displayData = response;
                    self.gotData = true;
                    $('.loader').addClass('hide');
                    $('.loader_background').addClass('hide');
                },
                function (response) {
                    console('error!');
                    $('.loader').addClass('hide');
                    $('.loader_background').addClass('hide');
                });
    };
    self.getGameData('current','NFL');
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
        .when('/aboutus', {
            templateUrl: 'pages/aboutus.html',
        })
        .when('/faq', {
            templateUrl: 'pages/faq.html'
        })
        .otherwise({
            redirectTo: '/'
        });
});

app.controller('leaderboard', function (myFactory) {
    var self = this;
    this.leaderboard_data = null;
    this.get_leaderboard_data = function(){
        $('.loader').removeClass('hide');
        $('.loader_background').removeClass('hide');
        myFactory.getLeaderData()
            .then(function (response) {
                    self.leaderboard_data=response;
                console.log(self.leaderboard_data);
                    $('.loader').addClass('hide');
                    $('.loader_background').addClass('hide');
                },
                function (response) {
                    console('error!');
                    $('.loader').addClass('hide');
                    $('.loader_background').addClass('hide');
                });
    }
    this.get_leaderboard_data();
});

app.controller('bethistory', function (myFactory) {
    var self = this;
    this.bet_history = null;
    this.get_bet_history = function(){
        $('.loader').removeClass('hide');
        $('.loader_background').removeClass('hide');
        myFactory.getBetHistoryData()
            .then(function (response) {
                $('.loader').addClass('hide');
                    $('.loader_background').addClass('hide');
                    self.bet_history=response;
                    console.log(self.bet_history);
                },
                function (response) {
                    $('.loader').addClass('hide');
                    $('.loader_background').addClass('hide');
                    console('error!');
                });
    }
    this.get_bet_history();
});
