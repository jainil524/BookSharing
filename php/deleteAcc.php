<?php
    require "dbconfig.php";
    session_start();
    $password =  hash("sha1", $_POST['password']);
    $CheckPassword = "SELECT user.password FROM user WHERE user.password = '".$password."' ";
    // echo $CheckPassword;
    $CheckPasswordData = mysqli_query($con,$CheckPassword);

    if(mysqli_num_rows($CheckPasswordData) > 0){
        $DeleteAccQuery = " DELETE FROM user WHERE user_id = ".$_SESSION['userID']." ";
        $DeleteAccFireQuery = mysqli_query($con,$DeleteAccQuery);

        // echo $DeleteAccQuery;

        if($DeleteAccFireQuery){
            echo trim("success");

            $DeleteBookQuery = " DELETE FROM book_transaction WHERE (seller_id = NULL OR seller_id = ".$_SESSION['userID'].") OR buyer_id = '' ";
            $DeleteBookFireQuery = mysqli_query($con,$DeleteBookQuery);
            session_destroy();
        }
        else{
            echo "something went wrong";
        }
    }
    else{
        echo "Incorrect password";
    }
?> 
