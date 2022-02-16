<?php
$title = "Profile - Book Sharing";
$css_file_name = "profile";
require_once "php/LoginCheck.php";
require_once "php/navbar.php";
require_once "php/dbconfig.php";
$fetchuserDetails = "SELECT * FROM user WHERE user_id = " . $_SESSION['userID'] . " ";
$result = mysqli_query($con, $fetchuserDetails);
$row = mysqli_fetch_assoc($result);
?>

<body>
    <div id="main">
        <aside id="sidebar">
            <div id="profilephoto">
                <img src="<?php echo $row['Profile_photo']; ?>" id="profileimg">
            </div>
            <div id="profileinfo">
                <ul>
                    <li class="active">Profile</li>
                    <li>Sold Books</li>
                    <li>Bought Books</li>
                    <li onclick="logout()">Logout</li>
                    <span class='activator'></span>
                </ul>
            </div>
        </aside>
        <div id="profile">
            <div class="header">
                <img src="img/close.svg" class="Formactive" id="CloseIcon" onclick="MakeFormDisable()">
                <h1>Edit Profile</h1>
                <img src="img/edit_icon.svg" alt="" onclick="MakeFormEditable()" id="EditIcon">
                <img src="img/done.svg" alt="" onclick="SendData()" class="Formactive" id="SubmitIcon">
            </div>
            <form method="post" disabled="disabled" id="ProfileForm">
                <div class="dp">
                    <div>
                        <img src="<?php echo $row['Profile_photo']; ?>" id="userimg" alt="">
                        <label class="changeimgicon" for="profiledp"><img src="img/add_a_photo.svg" class="edit_icon"></label>
                    </div>
                    <input type="file" name="dp" id="profiledp" onchange="userimgchanger()" class="user_info" accept="image/*" disabled>
                </div>
                <div>
                    <label>Full Name</label>
                    <input type="text" name="fname" class="user_info" value="<?php echo $row['fname']; ?>" disabled>
                </div>
                <div>
                    <label>User Name</label>
                    <input type="text" name="username" value="<?php echo $row['user_name']; ?>" class="user_info" id="" disabled>
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" class="user_info" id="" disabled>
                </div>
                <div>
                    <label>Address</label>
                    <textarea type="text" name="address" class="user_info" rows="3" cols="30" disabled><?php echo $row['address']; ?></textarea>
                </div>
                <div>
                    <label>Pincode</label>
                    <input type="number" name="pincode" value="<?php echo $row['pincode']; ?>" class="user_info" id="" disabled>
                </div>
            </form>
            <div class="Formactive response">
                <div><img src="img/warning_icon.svg"></div>
                <div class="errorMsg">fd f cxf fxdfcvx dvcx xfcv</div>
            </div>
        </div>
    </div>
</body>
<script src="js/profile.js"></script>
<script src="js/AJAX.js"></script>

</html>