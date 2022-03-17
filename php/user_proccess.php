<?php
    require "dbconfig.php";

    $RestrictUserQuery = "UPDATE user SET IsRestricted = 1 WHERE user_id = ".$_POST['user_id'];
    $RestrictUserFire = mysqli_query($con,$RestrictUserQuery);

    if($RestrictUserQuery){
        echo "user restricted Successfully";
    }
    else{
        echo "Something went wrong";
    }
?>