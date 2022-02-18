<?php
require "dbconfig.php";
session_start();
$query = "UPDATE book_transaction SET buyer_id=" . $_SESSION["userID"] . " WHERE book_id=" . $_POST["book_id"];

$result = mysqli_query($con, $query);
if ($result) {
    echo "Book succesfully reach to you in 1 week";
} else {
    echo "Something went wrong.Pleace try again";
}
