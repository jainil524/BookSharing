<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="js/AJAX.js"></script>
    <link rel="stylesheet" href="css/<?php echo $css_file_name ?>.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/navbar.css">
    <title><?php echo $title; ?></title>
</head>

<body>
    <header>
        <div class="logo_container">
            <a href="index.php"><img src="./img/logos.png" alt=""></a>
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
                <li><a href="?logout=true">Logout</a></li>
            <?php
            } else {
            ?>
                <li><a href="index.php" onclick="showHome()">Home</a></li>
                <li><a href="SellBook.php">Sell</a></li>
                <li><a href="chat.php">Chat</a></li>
                <li><a href="notification.php"><img src="img/notification_icon.svg" alt=""></a></li>
                <li>
                    <a href="profilepage.php">
                        <img src="<?php if (empty($_SESSION['profile_photo']) == true) echo (isset($_SESSION['userphoto']) ? $_SESSION["userphoto"] : "img/login_icon.svg");
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