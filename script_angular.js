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
                    data.bet_data = response.data;
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
    this.menu_toggle = false;
    var self = this;
    this.sendData={};
    this.displayData={};

    this.getGameData = function (game){
        self.sendData.date = game;
        console.log('the data I am sending the server is: ',self.sendData);

        myFactory.getData()
            .then(function(response){
                for(var i=0;i<response.length;i++){
                  response[i].bet_toggle = false;
                };
                console.log("response with toggle information: ",response)
                self.displayData=response;
            },
        function(response){
            console('error!');
        });
    };
});
