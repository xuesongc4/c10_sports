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

            //for(var i=0;i<response.length;i++){
                var game = $('<div>').addClass('game').on('click', function (){
                    console.log('game clicked!')
                });
                $('<span>').text(response.away_long).addClass('teams_playing').appendTo(game);
                $('<span>').text(response.home_long).addClass('teams_playing').appendTo(game);
                $('<span>').text(response.date).addClass('game_date').appendTo(game);
                $('<img>').attr('src',response.home_pic).addClass('home_img').appendTo(game);
                $('<img>').attr('src',response.away_pic).addClass('away_img').appendTo(game);
                $('.game_landing').append(game);
            //};
        }
    });
}

