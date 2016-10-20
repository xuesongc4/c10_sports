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
                $('<span>').text(response[i].spread[0],response[i].spread[2]).appendTo(bet).on('click', function(i){return function (){
                    high_light(this,i,response[i].spread[0],'');
                }}(i));
                $('<span>').text(response[i].spread[1],response[i].spread[3]).appendTo(bet).on('click',function(i){return function (){
                    high_light(this,i,response[i].spread[1],'');
                }}(i));
                $('<span>').text(response[i].money_line[0]).appendTo(bet).on('click', function(i){return function (){
                    high_light(this,i,response[i].money_line[0],'');
                }}(i));
                $('<span>').text(response[i].money_line[1]).appendTo(bet).on('click', function(i){return function (){
                    high_light(this,i,response[i].money_line[1],'');
                }}(i));
                $('<span>').text("OVER "+response[i].over_under).appendTo(bet).on('click', function(i){return function (){
                    high_light(this,i,response[i].over_under,'over','');
                }}(i));
                $('<span>').text("UNDER "+response[i].over_under).appendTo(bet).on('click', function(i){return function (){
                    high_light(this,i,response[i].over_under,'under','');
                }}(i));
                $('<span>').text('CONFIRM').addClass('confirm').appendTo(bet).on('click', function (){
                    high_light(this,'confirm');
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

function high_light(highlighter, confirm,game_id,type_bet,side,current_line){

    $(highlighter).addClass('selected');
    console.log('game id: '+game_id);
    console.log('type bet: '+type_bet);
    console.log('side: '+side);
    console.log('current line: '+current_line);
    console.log('confirm: '+ confirm);
}
