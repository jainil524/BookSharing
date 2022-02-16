<?php
session_start();
require "dbconfig.php";
print_r($POST['ProfileData']);
// $dprofile = $_REQUEST["imgPath"];
// $na  = $_POST['NAME'];
// $una = $_POST['UNAME'];
// $adr = $_POST['ADDR'];
// $em = $_POST['EMAIL'];
// $pinc = $_POST['PINCODE'];

move_uploaded_file($dprofile['tmp_name'], "media/profile_photos/" . $dprofile['name']);
$umg = $dprofile['name'];
$uimg = "media/profile_photos" . "$umg";
$UpdateQuery = "UPDATE user SET Profile_photo = '$uimg' WHERE user_name ='" . $_SESSION['username'] . "' ";
mysqli_query($con, $qry);

if($UpdateQuery){
    echo "success";
}
else{
    echo mysqli_error($conn);
}
?>