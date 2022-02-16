<?php
session_start();
require "dbconfig.php";
$uimg = "";
$dprofile = $_FILES["dp"];
// echo print_r($dprofile);
// exit();
$na = $_POST['fname'];
$una = $_POST['username'];
$adr = $_POST['address'];
$em = $_POST['email'];
$pinc = $_POST['pincode'];

if(empty($na) || empty($una) || empty($adr) || empty($na)){
    echo "Please fill all fields";
}    

if(isset($_FILES['dp'])){ 
    if(move_uploaded_file($_FILES['dp']['tmp_name'], "media/profile_photos/".$_FILES['dp']['name'])){
        $uimg = "media/profile_photos/".$_FILES['dp']['name'];  
        echo "yes";
        exit();
    }
} 
else{
    $uimg = "media/profile_photos/default.svg";
    exit();
}
    $UpdateQuery = "UPDATE user 
                    SET fname = '".$na."',
                    email= '".$em."',
                    user_name= '".$una."',
                    Profile_photo= '".$uimg."',
                    address = '".$adr."',
                    pincode=  '".$pinc."'
                    WHERE user_name ='" . $_SESSION['username'] . "' ";

    mysqli_query($con, $UpdateQuery);
        if($UpdateQuery){
            $_SESSION['username'] = $una;
            $_SESSION['profile_photo'] = $uimg;
            echo "successfully";
        }
        else{
            echo mysqli_error($conn);
        }


?>