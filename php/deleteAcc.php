<?php
    require "dbconfig.php";
    session_start();
    $password =  hash("sha1", $_POST['password']);
    $CheckPassword = "SELECT user.password FROM user WHERE user.password = '".$password."' ";
    // echo $CheckPassword;
    $CheckPasswordData = mysqli_query($con,$CheckPassword);

    if(mysqli_num_rows($CheckPasswordData) > 0){
        $DeleteAccQuery = " DELETE ut
                            FROM user ut
                            LEFT JOIN book_transaction on (ut.user_id = book_transaction.seller_id) 
                            AND (ut.user_id != book_transaction.buyer_id)
                            WHERE ut.user_id = ".$_SESSION['userID']." ";
        $DeleteAccFireQuery = mysqli_query($con,$DeleteAccQuery);

        // echo $DeleteAccQuery;

        if($DeleteAccFireQuery){
            echo trim("success");
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

