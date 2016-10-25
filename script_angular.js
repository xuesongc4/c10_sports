/**
 * Created by xueso on 10/24/2016.
 */
var app = angular.module('degenApp', []);

app.factory("myFactory", function($http, $q){
    var data = {};
        data.getData=function(){
            var q = $q.defer();
            $http({
                url: 'dummy_data.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
                .then(function (response) {
                    data.bet_data = response;
                    console.log("response in my factory: ",data);
                    q.resolve(data.bet_data);
                }, function () {
                    console.log('error in getting data');
                    q.reject('error in getting data')
                });
            return q.promise
        };
    return data;
});

app.controller('controller', function (myFactory) {
    var self = this;
    this.sendData={};

    this.getGameData = function (game){
        self.sendData.date = game;
        console.log('the data I am sending the server is: ',self.sendData);

        myFactory.getData()
            .then(function(response){
                console.log("response from server is: ",response)
            },
        function(response){
            console('error!');
        });
    };
});

// app.directive("schedLanding", function(){
//     return {
//         restrict: 'AE',
//         templateUrl: 'games_to_bet.html',
//         controller: function(){
//         this.arr = myFactory.bet_data;
//     },
//     controllerAs: 'sc'
//     }
// });
