//click handlers ------------------------------------------
$(document).ready(function () {

    $('.menu_button').on('click', function () {
        $('.whole_menu').animate({width: 'toggle'});
    });
    $('.menu_close').on('click', function () {
        $('.whole_menu').animate({width: 'toggle'});
    });
    $('#league_nfl').on('click', function () {
        console.log('nfl click!');

        $('.date_landing').empty();

        for(var i=1;i<=17;i++){
            var week = $('<div>').addClass('dates').text('Week '+i).data('league','nfl').on('click', function (){
                get_games('Week'+i,'nfl');
            });
            $('.date_landing').append(week);
        };
    });
});

//filling dom with dummy data ------------------------------
function get_games(date_data,league_data) {
    $('.sched_landing').empty();
    $.ajax({
        dataType: 'json',
        data: {
            date: date_data,
            league: league_data
        },
        url: "dummy_data.php",
        success: function (response) {
            console.log(response);

            for(var i=0;i<response.length;i++){
                var game = $('<div>').addClass('game').on('click', function (){
                    $(this).parent().find('.bet').slideToggle();
                });
                var bet = $('<div>').addClass('bet').on('click', function (){
                    //betting send to server function goes here!---------------------------
                });
                var game_landing = $('<div>').addClass('game_landing');
                var bet_landing = $('<div>').addClass('bet_landing');
                //bet data
                $('<span>').text(response[i].spread[0]+" "+response[i].spread[2]).appendTo(bet).on('click', function(i){return function (){
                    high_light(this,i,'spread',0,response[i].spread[0],response[i].spread[2]);
                }}(i));
                $('<span>').text(response[i].spread[1]+' '+response[i].spread[3]).appendTo(bet).on('click',function(i){return function (){
                    high_light(this,i,'spread',1,response[i].spread[1],response[i].spread[3]);
                }}(i));
                $('<span>').text(response[i].money_line[0]).appendTo(bet).on('click', function(i){return function (){
                    high_light(this,i,'money_line',0,response[i].money_line[0],response[i].money_line[0]);
                }}(i));
                $('<span>').text(response[i].money_line[1]).appendTo(bet).on('click', function(i){return function (){
                    high_light(this,i,'money_line',1,response[i].money_line[1],response[i].money_line[1]);
                }}(i));
                $('<span>').text("UNDER "+response[i].over_under[0]).appendTo(bet).on('click', function(i){return function (){
                    high_light(this,i,'over_under',0,response[i].over_under[0],response[i].over_under[1]);
                }}(i));
                $('<span>').text("OVER "+response[i].over_under[0]).appendTo(bet).on('click', function(i){return function (){
                    high_light(this,i,'over_under',1,response[i].over_under[0],response[i].over_under[2]);
                }}(i));
                $('<span>').text('CONFIRM').addClass('confirm btn btn-default').appendTo(bet).on('click', function (){
                    // Show confirm modal with confirm and cancel buttons - all options clear highlight selectors
                    $('#confirm_modal').modal('show');
                    $('.modal-body .confirm-mdl').on('click', function(){
                        send_data(this);
                    });
                    $('#confirm_modal').on('hidden.bs.modal', function (){
                        $('span').removeClass('selected');
                    });
                });
                //game data
                $('<span>').text(response[i].away_long).addClass('teams_playing').appendTo(game);
                $('<span>').text(response[i].home_long).addClass('teams_playing').appendTo(game);
                $('<span>').text(response[i].date).addClass('game_date').appendTo(game);
                $('<img>').attr('src',response[i].home_pic).addClass('home_img').appendTo(game);
                $('<img>').attr('src',response[i].away_pic).addClass('away_img').appendTo(game);

                //appending data to game and bet, appending game and bet to landing zone
                $(game_landing).append(game, bet);
                $('.sched_landing').append(game_landing);
                //};
            }
        }
    });
}

function high_light(highlighter, game_id1,type_of_bet1,side1,bet_line1,current_odds1){
    high_light.bet_data={
        game_id: game_id1,
        type_of_bet:type_of_bet1,
        side:side1,
        bet_line:bet_line1,
        current_odds:current_odds1
    };
    $('.bet, span').removeClass('selected');
    $(highlighter).addClass('selected');
    console.log('bet data being saved: ',high_light.bet_data);
}

function send_data(highlighter) {
    $(highlighter).addClass('selected');
    this.bet_data = high_light.bet_data;
    $.ajax({
        dataType: 'json',
        data: this.bet_data,
        url: "dummy_data.php",
        success: function (response) {
            console.log('bet data being sent is: ',bet_data);
            console.log("success?", response);
        }
    });
}