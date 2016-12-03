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
<body>
<video class="video" autoplay loop>
    <source src="video/blurred.mp4" type="video/mp4"/>
    Your browser does not support HTML5 video.
</video>
<div class="login_background"></div>
<div class="form">
    <div class="header">
        iBet
    </div>
    <div class="header2 loader2"></div>
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
                <div class="sign_up" onclick="display_sign_up()">
                    Sign Up
                </div>
            </div>
        </div>
        <div class="sign_up_menu">
            <input class="input_signup" type="text" name="username_signup" placeholder="Username" id="username" onblur="checkUsername()"><span class="warning">Username Taken</span><br>
            <input class="input_signup" type="text" name="email_signup" placeholder="Email"><br>
            <input id='password'class="input_signup" type="text" name="password_signup" placeholder="Password" onblur="checkPass()"><br>
            <input id='check_password'class="input_signup" type="text" name="password_signup_confirm" placeholder="Confirm Password" onblur="checkPass()"><span class="warning2">Passwords do not match</span><br>
            <button id="sign_up_button" class="user_login_notclick" name="signup">
                Sign Up
            </button>
            <button class="user_login2" name="cancel">
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

    var checkPass = function (){
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
    }



    var display_sign_up = function(){
        setTimeout(function(){
            $('.sign_up_menu').slideToggle()},250)
        $('.login').slideToggle();
    }
    var checkUsername = function(){
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
    }
</script>
<script>
    localStorage.removeItem('bet_user_id');
</script>
</body>
</html>