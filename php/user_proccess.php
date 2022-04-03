<?php
    require "dbconfig.php";
if(isset($_POST['Delete']) && $_POST['Delete']==true){
    $DeleteBookQuery = "DELETE FROM book_transaction WHERE book_id = ".$_POST['book_id'];
    $DeleteBookFire = mysqli_query($con,$DeleteBookQuery);

    if($DeleteBookFire){
        echo "Book Deleted Successfully";
    }
    else{
        echo "Something went wrong";
    }
}
else if(isset($_POST['OTP'])){
    $VerifyBookPinQuery = "SELECT book_id,BookPin FROM book_transaction WHERE book_id = ".$_POST['bookid']." AND BookPin = ".$_POST['OTP']." ";
    $VerifyBookPinFire = mysqli_query($con,$VerifyBookPinQuery);

    if($VerifyBookPinFire){
        $UpdateDeliveryStatusQuery = "UPDATE book_transaction SET IsDelivered = 1 WHERE book_id = ".$_POST['bookid']." AND BookPin = ".$_POST['OTP']." ";
        $UpdateDeliveryStatusFire = mysqli_query($con,$UpdateDeliveryStatusQuery);
        echo "Book Pin verify successfully";
    }
    else{
        echo "Something went wrong";
    }
    exit();
}
else{

    $RestrictUserQuery = "UPDATE user SET IsRestricted = 1 WHERE user_id = ".$_POST['user_id'];
    $RestrictUserFire = mysqli_query($con,$RestrictUserQuery);

    if($RestrictUserFire){
        echo "user restricted Successfully";
    }
    else{
        echo "Something went wrong";
    }
}

?>