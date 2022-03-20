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