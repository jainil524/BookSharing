<?php
// login page php function
require 'dbconfig.php';
session_start();

$email = mysqli_real_escape_string($con, $_POST['useremail']);
$pw = mysqli_real_escape_string($con, $_POST['pass']);

if (empty($email) || empty($pw)) {
	echo "Please Enter All Fields";
	exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo "Please Match Proper Email Formate:- Example123@gmail.com";
	exit();
} else {
	$h_pass = hash("sha1", $pw);

	$SelectUserQuery = "SELECT * FROM user WHERE IsRestricted = 0 AND (email = '" . trim($email) . "' AND password = '" . trim($h_pass) . "') ";
	$SelectUserFire = mysqli_query($con, $SelectUserQuery);

	if (mysqli_num_rows($SelectUserFire) == 0) {
		$SelectDeliveryGuyQuery = "SELECT * FROM delivery_guy where delivery_guy_email  = '" . trim($email) . "' AND delivery_guy_password = '" . trim($h_pass) . "' ";
		$SelectDeliveryGuyFire = mysqli_query($con, $SelectDeliveryGuyQuery);
		$SelectDeliveryGuyResult = mysqli_fetch_assoc($SelectDeliveryGuyFire);

		if (mysqli_num_rows($SelectDeliveryGuyFire) > 0) {
			$_SESSION["role"] = "DeliveryGuy";
			$_SESSION['username'] = $SelectDeliveryGuyResult['delivery_guy_name'];
			$_SESSION["userID"] = $SelectDeliveryGuyResult["delivery_guy_id"];
			echo "successDelivery";
		} else {
			$SelectAdminQuery = "SELECT * FROM admin where admin_email  = '" . trim($email) . "' AND password = '" . trim($h_pass) . "' ";
			$SelectAdminFire = mysqli_query($con, $SelectAdminQuery);
			$SelectAdminResult = mysqli_fetch_assoc($SelectAdminFire);


			if (mysqli_num_rows($SelectAdminFire) > 0) {
				$_SESSION["role"] = "admin";
				$_SESSION['username'] = $SelectAdminResult['admin_name'];
				$_SESSION["userID"] = $SelectAdminResult["admin_id"];
				echo "successAdmin";
			} else {
				echo "Invalid Email/password\nor may be\n Your account is restricted";
				exit();
			}
		}
	} else {
		$SelectUserResult = mysqli_fetch_assoc($SelectUserFire);
		$_SESSION["role"] = "user";
		$_SESSION['username'] = $SelectUserResult['user_name'];
		$_SESSION["fname"] = $SelectUserResult["fname"];
		$_SESSION["userID"] = $SelectUserResult["user_id"];
		$_SESSION["email"] = $SelectUserResult["email"];
		$_SESSION["pincode"] = $SelectUserResult["pincode"];
		$_SESSION["Address"] = $SelectUserResult["address"];
		$_SESSION["userphoto"] = $SelectUserResult["Profile_photo"];
		$_SESSION['lgcheck'] = true;
		echo "successUser";
	}
}
