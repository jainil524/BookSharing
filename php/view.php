<?php
require "dbconfig.php";
session_start();

$selectQuery = "SELECT msgid,usermsg,sender,receiver,send_time FROM usermessages where 
			   (sender = {$_SESSION["userID"]} AND receiver = {$_SESSION["rid"]})
			   OR (sender = {$_SESSION["rid"]} AND receiver = {$_SESSION["userID"]})
			   ORDER BY send_time";
$res = mysqli_query($con, $selectQuery);
$AllChat = '';
while ($row = mysqli_fetch_assoc($res)) {
	if ($_SESSION['userID'] == $row['sender']) {
		$AllChat .= '<div class="msgshowingarea sender" >
						<div class="msgcontainer"><span class="msgownername">You</span><span onclick="DeleteChat(event,'.$_SESSION["userID"].','.$row['msgid'].')"><img src="img/delete_icon.svg"></span></div>
						<div class="msg"><p class="usermsg">' . $row["usermsg"] . '</p>
					</div>';
	} else {
		$AllChat .= '<div  class="msgshowingarea reciver">
						<div class="msgcontainer"><span class="msgownername">' . $_SESSION['rname'] . '</span></div>
						<div class="msg"><p class="usermsg">' . $row['usermsg'] . '</p>
					</div>';
	}
	$AllChat .= '<span class="timer">' . substr($row['send_time'], 11, 5) . '</span></div></div>';
}

echo json_encode($AllChat);
