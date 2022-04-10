<?php
require "dbconfig.php";
session_start();
$msg = mysqli_real_escape_string($con, $_POST['usermsg']);

if(isset($_POST['Deleted']) && $_POST['Deleted'] == true){
	$selectuserid = "DELETE FROM usermessages where msgID = '{$_POST['msgID']}' ";
	$result = mysqli_query($con, $selectuserid);
	if($result){
		echo "Deleted successfully";
	}
	else{
		echo "Failed to delete";
	}
}

else if (!empty($msg)) {
	$selectuserid = "SELECT user_id from user where user_name = '{$_SESSION["username"]}' ";
	$result = mysqli_query($con, $selectuserid);
	$row = mysqli_fetch_assoc($result);
	$insertMSG = "INSERT INTO usermessages(sender,receiver,usermsg) 
					VALUES({$row["user_id"]},{$_SESSION["rid"]},'{$msg}')";

	$result = mysqli_query($con, $insertMSG);
}
