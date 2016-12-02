<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>iBet</title>
    <link href="https://fonts.googleapis.com/css?family=Concert+One|Khand|Roboto+Condensed" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

    <script>
        display_sign_up = function(){
            setTimeout(function(){
                $('.sign_up_menu').slideToggle()},250)
            $('.login').slideToggle();
        }
        checkUsername(username){
            $.ajax({
                url: 'api/check_user.php',
                type: "POST",
                data: {
                    username: username
                }
            })
                .done(function(data) {
                    console.log'(your user name stuff',data);
                })
                .fail(function() {
                    alert("unable to reach user name database");
                });
        }
    </script>

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
            <input class="input" type="text" name="username_signup" placeholder="Username" id="username" onblur="checkUsername($('#username').val())"><br>
            <input class="input" type="text" name="email_signup" placeholder="Email"><br>
            <input class="input" type="password" name="password_signup" placeholder="Password"><br>
            <input class="input" type="password" name="password_signup_confirm" placeholder="Confirm Password"><br>
            <button class="user_login" name="user_login">
                Sign Up
            </button>
        </div>
    </form>
</div>
<script>
    $('.user_login').on('click', function () {
        $('.header2').css('display', 'initial');
    });
</script>
<script>
    localStorage.removeItem('bet_user_id');
</script>
</body>
</html>