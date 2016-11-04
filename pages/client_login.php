<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="api/login.php" method="post">
        <input type="text" name="username">
        <br>
        <input type="password" name="password">
        <br>
        <button name="login">Login</button>
    </form>
    <script>
        localStorage.removeItem('bet_user_id');
    </script>
</body>
</html>