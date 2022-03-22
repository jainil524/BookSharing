<?php
require "dbconfig.php";

$query = "INSERT INTO `warn_user_delivery_guy`(`warn_user_id`, `warning_messge`) VALUES (" . $_POST["userId"] . ",'" . $_POST["reason"] . "')";

$result = mysqli_query($con, $query);

if ($result == 1) {
    echo "User Warned";
} else {
    echo "Something went wrong";
}
