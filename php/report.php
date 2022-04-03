<?php
require "dbconfig.php";
session_start();

$query = "INSERT INTO reports(Report_msg, reporter_user, reported_user) VALUES ('" . $_POST["reason"] . "'," . $_SESSION["userID"] . "," . $_POST["repotedUser"] . ")";
$result = mysqli_query($con, $query);

if ($result == 1) {
    echo "successfully reported";
} else {
    echo "Something went wrong";
}
