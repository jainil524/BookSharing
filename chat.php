<html>

<head>
	<?php
	require "php/Logincheck.php";
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script src="js/AJAX.js"></script>

	<link rel="stylesheet" href="css/chatting-css.css">
	<link rel="stylesheet" href="css/common.css">
	<title>CHATTING APPLICATION</title>
</head>

<body onsubmit="return false;" onload="firstfocuser()">
	<div class="chattedwithusersection">
		<div id="searchuser">
			<div id="accountOwner">
				<span id="user_profile">
					<img src="<?php echo $_SESSION['userphoto']; ?>" alt="">
				</span>
				<span id="user_name">
					<span><?php echo $_SESSION['username']; ?>
						<h6 style="margin-left:.5rem;display: inline;color:teal;font-weight:bold;">
							<sub>(YOU)</sub>
						</h6>
					</span>
				</span>
			</div>
			<form id="usertosearch" class="searchbar">
				<input type="search" placeholder="Search user" name="usersearch" id="usersearch" oninput="usersSearches()">
			</form>
		</div>
		<div id="allusers">
			<?php
			require "php/dbconfig.php";
			$id = 0;
			$users = '';
			if (isset($_GET['id']) && is_numeric($_GET['id'])) {

				$id = $_GET['id'];
				$Buser = "SELECT * from user where user_id = {$_GET['id']} ";
				$res1 = mysqli_query($con, $Buser);
				if (mysqli_num_rows($res1)) {
					$row1 = mysqli_fetch_assoc($res1);
					$users .= "<div class='user' tabindex='1' onclick='userid({$row1["user_id"]})'>
						   	<img src='{$row1['Profile_photo']}'>
						   	<span>{$row1['user_name']}</span>
						   	</div>";
				}
			}
			$SelectAllUser = "SELECT  distinct user_id ,Profile_photo , user_name FROM user
							INNER JOIN  usermessages 
							ON usermessages.receiver = user.user_id
							OR usermessages.sender = user.user_id
							WHERE ((user.user_id != {$id}) AND (user.user_id != {$_SESSION['userID']})) 
							AND ((usermessages.receiver = {$_SESSION['userID']}) OR (usermessages.sender = {$_SESSION['userID']}))
							ORDER BY usermessages.send_time ASC";

			$res = mysqli_query($con, $SelectAllUser);
			while ($row = mysqli_fetch_assoc($res)) {
				$users .= "<div class='user' tabindex='1' onclick='userid({$row["user_id"]})'>
				<img src='{$row['Profile_photo']}'>
				<span>{$row['user_name']}</span>
				</div>";
			}
			if (empty($users)) {
				echo "<span class='NoUser'>No User For Chat</span>";
			} else {
				echo $users;
				$_SESSION['userlist'] = $users;
			}
			?>
		</div>

	</div>
	<div class="Msgcontainer" id="Msgcontainer">
		<div class="ConUserInfo">

		</div>
		<div id="msgcontainer">

		</div>
	</div>
	<form method="post" id="msgsendinginput">
		<div class="input msginputbox">
			<input type="text" name="usermsg" placeholder="Enter Message..." id="inputmsg" autocomplete="off">
		</div>

		<div class="input msgsendbtn">
			<button type="submit" id="sendMSG" value="send"><img src="img/send.svg"></button>
		</div>
	</form>
</body>
<script type="text/javascript" src="js/chat_send.js"></script>

</html>