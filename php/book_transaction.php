<?php
require "dbconfig.php";
session_start();
$rand = rand(1000,20000);

// $SelectDeliveryItemQuery = "SELECT delivery_guy_id ,COUNT(delivery_guy_id) as mincount FROM book_transaction GROUP BY delivery_guy_id";
// $SelectDeliveryItemFire = mysqli_query($con,$SelectDeliveryItemQuery);

// $mincount = 10000000000;
// $deliveryID = 1;

// while($row = mysqli_fetch_assoc($SelectDeliveryItemFire)){
//     // print_r($row);
//     if($mincount > $row['mincount']){
//         $mincount = $row['mincount'];
//         $deliveryID = $row['delivery_guy_id'];
//     }
// }

$query = "UPDATE book_transaction SET buyer_id=" . $_POST["userID"] . ",BookPin =".$rand ." WHERE book_id=" . $_POST["book_id"];

$result = mysqli_query($con, $query);
if ($result) {
    echo "Book succesfully reach to you in 1 week";
} else {
    echo "Something went wrong.Pleace try again";
}
