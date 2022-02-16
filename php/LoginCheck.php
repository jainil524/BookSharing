<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['lgcheck']) == false) {
    header('location:login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("location:login.php");
    }
}
