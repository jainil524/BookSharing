<?php
require "dbconfig.php";
session_start();
if (isset($_POST['usersearch'])) {
    if (!empty($_POST['usersearch'])) {
        $users = '';
        $searchuser = "SELECT user_id,user_name,Profile_photo FROM user WHERE user_name like'%" . $_POST['usersearch'] . "%' AND user_id != " . $_SESSION['userID'] . " ";
        $res = mysqli_query($con, $searchuser);
        if (mysqli_num_rows($res) != 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $users .= " <div class='user' tabindex='1' onclick='userid({$row['user_id']})'>
					            <img src='" . $row['Profile_photo'] . "'>
					            <span>" . $row['user_name'] . "</span>
				            </div>";
            }
            echo json_encode($users);
        }
    } else {
        echo json_encode($_SESSION['userlist']);
    }
} else {
    if (!empty($_POST['Rid'])) {
        $Rid = $_POST['Rid'];

        $_SESSION['rid'] = $Rid;

        $selectQuery1 = "SELECT user_name,Profile_Photo FROM user where user_id = '" . $_SESSION['rid'] . "' ";
        $res1 = mysqli_query($con, $selectQuery1);
        if (mysqli_num_rows($res1) != 0) {
            $row1 = mysqli_fetch_assoc($res1);
            $AllChat = '';
            $_SESSION['rname'] = $row1['user_name'];
            $AllChat .= '<div class="ConUserInfoDiv">
                            <img src="' . $row1['Profile_Photo'] . '">
                            <span>' . $row1['user_name'] . '</span>
                        </div>
                        <ul id="burger" class="cancel" onclick="chttedwithusersection()">
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>';

            echo json_encode($AllChat);
        }
    } else {
        echo json_encode("There is no user found");
    }
}
