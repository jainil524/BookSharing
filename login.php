<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <script src="js/AJAX.js"></script>
    <script src="js/loginSignUp.js" type="text/javascript"></script>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/common.css">
    <title>LOGIN PAGE</title>
</head>

<body id="main">
    <form enctype="multipart/form-data" id="login" method="POST">
        <span>Login</span>
        <div class="userinput">
            <div id="error">
                <p id="error-msg"></p>
            </div>
        </div>
        <div class="userinput">
            <input class="u_email" name="useremail" placeholder="Email" type="text">
        </div>

        <div class="userinput password">
            <input autocomplete="off" class="u_password" name="pass" placeholder="password" type="password">
            <img class="passshow" onclick="passhw()" src="img/password_not_show.svg">
        </div>
        <div class="userinput">
            <button onclick="loginFunction()" type="button">LOGIN</button>
        </div>
        <div class="userinput">
            <span class="newac">Don't have account?
                <a href="#" onclick="change('./sign-up.php')">SIGN UP</a>
            </span>
        </div>
    </form>
</body>

</html>