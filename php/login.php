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

	$q = "SELECT * FROM user where email = '" . trim($email) . "' AND password = '" . trim($h_pass) . "' ";
	$result = mysqli_query($con, $q);
	$num = mysqli_num_rows($result);


	if ($num == 0) {
		$adminq = "SELECT * FROM admin where admin_email  = '" . trim($email) . "' AND password = '" . trim($h_pass) . "' ";
		$adminfire = mysqli_query($con, $adminq);
		$adminresult = mysqli_fetch_assoc($adminfire);
		$numrow = mysqli_num_rows($adminfire);

		if ($numrow > 0) {
			$_SESSION["role"] = "admin";
			$_SESSION["userID"] = $adminresult["admin_id"];
			echo $adminq;
			echo mysqli_error($con);
			echo "successAdmin";
		} else {
			echo "Data not found";
			exit();
		}
	} else {
		$_SESSION["role"] = "user";
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['user_name'];
		$_SESSION["fname"] = $row["fname"];
		$_SESSION["userID"] = $row["user_id"];
		$_SESSION["email"] = $row["email"];
		$_SESSION["pincode"] = $row["pincode"];
		$_SESSION["Address"] = $row["address"];
		$_SESSION["userphoto"] = $row["Profile_photo"];
		$_SESSION['lgcheck'] = true;
		echo "successUser";
	}
}
