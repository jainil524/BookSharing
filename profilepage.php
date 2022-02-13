<?php
$title = "Profile - Book Sharing";
$css_file_name = "profile";
require_once "php/LoginCheck.php";
require_once "php/navbar.php";
?>

<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/navbar.css" >
    <title>Book Sharing</title>
</head>
<?php
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
                <h1>Edit Profile</h1>
                <img src="img/done.svg" alt="">
            </div>
            <form id="profileForm" method="post" disabled="disabled">
                <label class="dp" for="profiledp">
                    <img src="<?php echo $row['Profile_photo']; ?>" id="userimg" alt="">
                    <span class="changeimgicon"><img src="img/add_a_photo.svg" class="edit_icon"></span>
                </label>

                <input type="file" name="dp" id="profiledp" onchange="userimgchanger()" class="user_info" accept="image/*" disabled>

                <label>Full Name</label>
                <input type="text" name="fname" id="" class="user_info" value="<?php echo $row['fname']; ?>" disabled>
                <img src="img/edit_icon.svg" alt="" class="edit_icon">

                <label>User Name</label>
                <input type="text" name="username" value="<?php echo $row['user_name']; ?>" class="user_info" id="" disabled>
                <img src="img/edit_icon.svg" alt="" class="edit_icon">

                <label>Email</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" class="user_info" id="" disabled>
                <img src="img/edit_icon.svg" alt="" class="edit_icon">

                <label>Address</label>
                <input type="text" name="address" value="<?php echo $row['address']; ?>" class="user_info" id="" disabled>
                <img src="img/edit_icon.svg" alt="" class="edit_icon">

                <label>Pincode</label>
                <input type="number" name="pincode" value="<?php echo $row['pincode']; ?>" class="user_info" id="" disabled>
                <img src="img/edit_icon.svg" alt="" class="edit_icon">
            </form>
            <div class="response">
               
            </div>
        </div>

    </div>
</body>
<script src="js/profile.js"></script>
<script src="js/AJAX.js"></script>

</html>