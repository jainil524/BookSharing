<?php
require "dbconfig.php";
session_start();
$rand = rand(100000,999999);

$SelectDeliveryItemQuery = "SELECT dg.delivery_guy_id as dgID,(SELECT COUNT(bt.delivery_guy_id) as dd FROM book_transaction bt WHERE (bt.delivery_guy_id = dg.delivery_guy_id AND bt.delivery_guy_id IS NOT NULL GROUP BY bt.delivery_guy_id) AND IsDelivered = 0) as mincount FROM delivery_guy dg ORDER BY mincount LIMIT 1";
$SelectDeliveryItemFire = mysqli_query($con,$SelectDeliveryItemQuery);
$row = mysqli_fetch_assoc($SelectDeliveryItemFire);

$query = "UPDATE book_transaction SET 
            buyer_id = " . $_POST["userID"] . ",
            delivery_guy_id = ".$row['dgID'] .",
            BookPin = ".$rand." 
            WHERE book_id=" . $_POST["book_id"]." ";

$result = mysqli_query($con, $query);
if ($result) {
    echo "Book succesfully reach to you in 1 week";
} else {
    echo "Something went wrong.Pleace try again";
}
