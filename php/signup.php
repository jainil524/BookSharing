<?php
require 'dbconfig.php';

$n = mysqli_real_escape_string($con, $_POST['name']);
$un = mysqli_real_escape_string($con, $_POST['username']);
$ei = mysqli_real_escape_string($con, $_POST['email']);
$addr = mysqli_real_escape_string($con, $_POST['address']);
$pin = mysqli_real_escape_string($con, $_POST['pincode']);
$pw = mysqli_real_escape_string($con, $_POST['pass']);

if (empty($n) || empty($un) || empty($ei) || empty($addr) || empty($pin) || empty($pw)) {
	echo "Please Fill All Fields";
	exit();
}
if (!filter_var($ei, FILTER_VALIDATE_EMAIL)) {
	echo "Please Match Proper Email Formate:-Example123@gmail.com";
	exit();
}
if (!is_numeric($pin)) {
	echo "PinCode Must be a Number";
	exit();
}
if (strlen($pw) < 8) {
	echo "Password Must have 8 letters";
	exit();
} else {
	$h_pass = hash("sha1", $pw);
	$q = "select * from user where email = '$ei' || user_name = '$un' ";
	$result = mysqli_query($con, $q);
	$num = mysqli_num_rows($result);

	if ($num != 0) {
		echo "Please Try Deffrent Email or user name";
		exit();
	} else {
		$qi = "INSERT INTO user(fname , user_name ,email ,address,pincode,password) values('" . $n . "' , '" . trim($un) . "' , '" . trim($ei) . "' ,'" . trim($addr) . "'," . trim($pin) . ", '" . trim($h_pass) . "')";
		mysqli_query($con, $qi);
		echo "success";
	}
}
