<?php
require "dbconfig.php";
session_start();
$rand = rand(1000,20000);
$query = "UPDATE book_transaction SET buyer_id=" . $_POST["userID"] . ",BookPin =".$rand ." WHERE book_id=" . $_POST["book_id"];

$result = mysqli_query($con, $query);
if ($result) {
    echo "Book succesfully reach to you in 1 week";
} else {
    echo "Something went wrong.Pleace try again";
}
