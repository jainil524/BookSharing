<?php
session_start();
require "dbconfig.php";

$dprofile = $_REQUEST["dp"];
$na  = $_POST['fname'];
$una = $_POST['username'];
$adr = $_POST['address'];
$em = $_POST['email'];
$pinc = $_POST['pincode'];

if($dprofile != "media/profile_photos/default_photo.svg"){
    move_uploaded_file($dprofile['tmp_name'], "media/profile_photos/" . $dprofile['name']);
    $umg = $dprofile['name'];
    $uimg = "media/profile_photos" . "$umg";
}
    $UpdateQuery = "UPDATE user 
                    SET fname = '".$na."',
                    email= '".$em."',
                    user_name= '".$una."',
                    Profile_photo= '".$dprofile."',
                    address = '".$adr."',
                    pincode=  '".$pinc."'
                    WHERE user_name ='" . $_SESSION['username'] . "' ";
    mysqli_query($con, $qry);
        if($UpdateQuery){
            $_SESSION['username'] = $una;
            $_SESSION['profile_photo'] = $uimg;
            echo "successfully";
        }
        else{
            echo mysqli_error($conn);
        }


?>