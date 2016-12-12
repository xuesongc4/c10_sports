<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>iBet</title>
    <link href="https://fonts.googleapis.com/css?family=Concert+One|Khand|Roboto+Condensed" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id="login_body">
    <video class="video" muted="muted" loop="loop" autoplay="autoplay">
        <source src="video/blurred.webm" type="video/webm">
        your browser does not support html5 video
    </video>

<div class="login_background"></div>
    <div class="background"></div>
<div class="form">
    <div class="header">
        iBet
    </div>
    <div class="header2 loader2"></div>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<span class="warning3">' . $_SESSION['message'] . '</span>';
    }
    ?>
    <form action="api/login.php" method="post">
        <div class="login">
            <input class="input" type="text" name="username" placeholder="Username"><br>
            <input class="input" type="password" name="password" placeholder="Password"><br>
            <button class="user_login" name="login">
                Login
            </button>
            <div class="guest_signup">
                <button class="guest_login" name="guest">
                    Guest Login
                </button>
                <button type="button" class="sign_up" onclick="display_sign_up()">
                    Sign Up
                </button>
            </div>
        </div>

        <div class="sign_up_menu">
            <input class="input_signup" type="text" name="username_signup" placeholder="Username" id="username" onkeypress="checkUsername()"><span class="warning">Username Taken</span><br>
            <input id='password'class="input_signup" type="password" name="password_signup" placeholder="Password" onkeypress="checkPass()"><br>
            <input id='check_password'class="input_signup" type="password" name="password_signup_confirm" placeholder="Confirm Password" onkeypress="checkPass()"><span class="warning2">Passwords do not match</span><br>
            <input class="input_signup" type="text" name="email_signup" placeholder="Email"><br>
            <button id="sign_up_button" class="user_login_notclick" name="signup" onclick="show_load()">
                Sign Up
            </button>
            <button type='button'class="user_login2" name="cancel" onclick="display_login()">
                Cancel
            </button>
        </div>
    </form>
</div>

<script>
    var newUser = false;
    var matchPass = false;
    var password_val = $('.password').val()!=''

    $('.user_login,.guest_login').on('click', function () {
        $('.header2').css('display', 'initial');
        setTimeout(function(){
            $('.header2').css('display', 'none');
        },2000);
    });

    var check_sign_up = function(){
        if((password_val != '')&&newUser&&matchPass) {
            $('#sign_up_button').removeClass();
            $('#sign_up_button').addClass('user_login2');
        }
        else{
            $('#sign_up_button').removeClass();
            $('#sign_up_button').addClass('user_login_notclick');
        }
    }

    var show_load = function(){
        $('.header2').show();
    }

    var passTimeout;
    var checkPass = function (){
        clearTimeout(passTimeout);
        passTimeout = setTimeout(function() {
            var value1 = $('#password').val();
            var value2 = $('#check_password').val();

            if(value1=='' || value2==''){
                matchPass = false;
                check_sign_up();
                return;
            }
            if (value1 !== value2){
                $('.warning2').slideToggle();
                matchPass = false;
                check_sign_up();
            }
            else{
                $('.warning2').hide();
                matchPass = true;
                check_sign_up();
            }
        },800);
    }
    
    var display_login = function(){
        setTimeout(function(){
            $('.input_signup').val('');
            $('.warning2').hide();
            $('.warning').hide();
            newUser = false;
            matchPass = false;
            $('.login').slideToggle()},250)
        $('.sign_up_menu').slideToggle();
    }


    var display_sign_up = function(){
        
        setTimeout(function(){
            $('.warning3').hide();
            $('.sign_up_menu').slideToggle()
        },250);
        
        $('.login').slideToggle();
    }
    
    var ajaxTimeout;
    var checkUsername = function(){
        clearTimeout(ajaxTimeout);
        ajaxTimeout = setTimeout(function() {
            console.log('sent');
            $.ajax({
                url: 'api/check_user.php',
                type: "POST",
                dataType: 'JSON',
                data: {
                    username: $('#username').val()
                }
            })
            .done(function(data) {

                if(data.userFound) {
                    console.log(data.userFound);
                    newUser = false;
                    $('.warning').slideToggle();
                    check_sign_up()
                }
                else{
                    $('.warning').hide();
                    newUser = true;
                    check_sign_up();
                }
            })
            .fail(function() {
                alert("unable to reach user name database");
            });
        }, 700);
    };
</script>
<script>
    localStorage.removeItem('bet_user_id');
</script>
</body>
</html>