<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo_without_text.png" type="image/x-icon">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/loading.css">
    <link rel="stylesheet" href="css/<?php echo $css_file_name ?>.css">
    <link rel="shortcut icon" href="img/logo_with_text.png" type="image/x-icon">
    <link rel="stylesheet" href="css/navbar.css">
    <script defer src="js/AJAX.js"></script>
    <script defer src="js/loader.js"></script>
    <title><?php echo $title; ?></title>
</head>

<body>
<div id="loader">
    <div class="imgContainer">
        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="244.000000pt" height="281.000000pt" viewBox="0 0 244.000000 281.000000" preserveAspectRatio="xMidYMid meet">
          <g
            transform="translate(0.000000,281.000000) scale(0.100000,-0.100000)"
            fill="#000000"
            stroke="none">
            <path d="M12 2028 l3 -763 920 -5 c1007 -6 946 -2 1065 -69 l65 -36 -973 -3
                -973 -2 3 -68 3 -67 1036 -3 1036 -2 26 -49 c15 -27 27 -51 27 -55 0 -3 -479
                -6 -1065 -6 l-1065 0 0 -65 0 -65 1080 0 1080 0 6 -24 c3 -13 4 -38 2 -57 l-3
                -34 -1083 -3 -1083 -2 3 -68 3 -67 1057 0 c581 0 1059 -3 1062 -6 3 -3 -6 -29
                -21 -57 l-27 -52 -1038 0 -1038 0 0 -64 c0 -53 3 -66 18 -69 9 -3 436 -4 949
                -4 512 1 941 0 953 -3 31 -7 -75 -63 -170 -89 -73 -21 -95 -21 -967 -21 l-893
                0 0 -70 0 -70 894 0 c974 0 973 0 1101 57 198 88 349 266 401 473 36 141 20
                322 -38 449 -92 199 -272 349 -478 399 -54 13 -165 16 -657 19 -326 3 -593 7
                -593 11 0 4 41 68 90 142 50 74 90 140 90 147 0 6 -13 31 -29 55 -26 40 -106
                165 -137 215 -8 12 -14 27 -14 33 0 13 1075 13 1175 0 180 -24 353 -123 466
                -268 30 -39 32 -37 77 53 48 95 66 176 66 300 0 81 -6 128 -21 180 -61 211
                -201 371 -399 458 -129 58 -111 57 -1092 57 l-902 0 2 -762z" />
          </g>
        </svg>
        <p class="FirstWave"></p>
        <p class="secondWave"></p>
    </div>
</div>
    <header>
        <div class="logo_container">
            <a href="index.php"><img src="./img/logo_with_text.png" alt=""></a>
        </div>
        <ul id="navbar">
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ((isset($_SESSION["role"]) && $_SESSION["role"] == "admin")) {
            ?>
                <li><a href="admindashboard.php" onclick="showHome()">Dashbord</a></li>
                <li><a href="user.php">Users</a></li>
                <li><a href="deliveryGuys.php">DeliveryGuy</a></li>
                <li><a href="books.php">Books</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="?logout=true">Logout</a></li>
            <?php
            }else if ((isset($_SESSION["role"]) && $_SESSION["role"] == "DeliveryGuy")) {
            ?>
                <li><a href="deliverys.php">Deliverys</a></li>
                <li><a href="notification.php"><img src="img/notification_icon.svg" alt=""></a></li>
                <li><a href="profilepage.php">profile</a></li>
            <?php
            } else {
            ?>
                <li><a href="index.php" onclick="showHome()">Home</a></li>
                <li><a href="SellBook.php">Sell</a></li>
                <li><a href="chat.php">Chat</a></li>
                <li><a href="notification.php"><img src="img/notification_icon.svg" alt=""></a></li>
                <li>
                    <a href="profilepage.php">
                        <img src="<?php if (isset($_SESSION['userID'])) echo "img/login_icon.svg";
                                    else echo $_SESSION['profile_photo'] ?>" alt="">
                    </a>
                </li>
            <?php } ?>
        </ul>

        <ul id="burger" onclick="showNavbar()">
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </header>

    <script defer>
        let navbar = document.querySelector("#navbar");
        let burger = document.querySelector("#burger");

        function showNavbar() {
            if (navbar.style.transform == '') {
                navbar.style.transform = " translateX(0%) scaleX(1)";
            } else {
                navbar.style.transform = "";
            }

            burger.classList.toggle("cancel");
        }

        function showHome() {
            burger.classList.remove("cancel");
            navbar.style.transform = "";
        }
    </script>