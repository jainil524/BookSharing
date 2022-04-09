<?php
require_once "php/LoginCheck.php";
require "php/RoleChecker.php";
Rlchecker("user", 403, "Access Denied", "You don't have permission the access this page");

$title = "Profile - Book Sharing";
$css_file_name = "profile";
require_once "php/navbar.php";
require_once "php/dbconfig.php";

$profilePhoto = "";
$fullname = "";
$email = "";
$username = "";
$pincode = "";
$address = "";
        if($_SESSION['role'] == "user"){
            $fetchuserDetails = "SELECT * FROM user WHERE user_id = " . $_SESSION['userID'] . " ";
            $result = mysqli_query($con, $fetchuserDetails);
            $row = mysqli_fetch_assoc($result);
            
            $profilePhoto = $row['Profile_photo'];
            $fullname = $row['fname'];
            $username = $row['user_name'];
            $email = $row['email'];
            $address = $row['address'];
            $pincode = $row['pincode'];
        }
        else if($_SESSION['role'] == "DeliveryGuy"){
            $fetchDeliveryDetails = "SELECT * FROM delivery_guy WHERE delivery_guy_id = " . $_SESSION['userID'] . " ";
            $result = mysqli_query($con, $fetchDeliveryDetails);
            $row = mysqli_fetch_assoc($result);
            $profilePhoto = $row['Profile_photo'];
            $fullname = $row['delivery_guy_name'];
            $username = $row['delivery_guy_name'];
            $email = $row['delivery_guy_email'];
            $address = $row['delivery_guy_address'];
            $pincode = $row['delivery_guy_pincode'];
        }
        ?>

<div id="main">
    <aside id="sidebar">
        <div id="profilephoto">
            <img src="<?php echo (empty($profilePhoto)?"media/profile_photos/default_photo.svg":$profilePhoto); ?>" id="profileimg">
        </div>
        <div id="profileinfo">
            <ul>
                <li class="active slider">Profile</li>
                <?php
                if ($_SESSION['role'] == "user") {
                ?>
                    <li class="slider">Your Books</li>
                    <li class="slider">Sold Books</li>
                    <li class="slider">Purchased Books</li>
                    <li onclick="DeleteAccount()">Delete Account</li>
                <?php
                }
                ?>
                <li onclick="logout()">Logout</li>
                <span class='activator'></span>
            </ul>
        </div>
    </aside>

    <!-- main container where all aside's menu items content will be shown here  -->
    <div id="profile">
        <!-- profile  page structure-->
        <div class="profile_container ProfileActive">
            <?php if($_SESSION['role']=="user"){?>
            <div class="header">
                <img src="img/close.svg" class="Formactive" id="CloseIcon" onclick="MakeFormDisable()">
                <h1>Edit Profile</h1>
                <img src="img/edit_icon.svg" alt="" onclick="MakeFormEditable()" id="EditIcon">
                <img src="img/done.svg" alt="" onclick="SendData()" class="Formactive" id="SubmitIcon">
            </div>
            <?php }?>
            <form method="post" id="ProfileForm">
                <div class="dp">
                    <div>
                        <img src="<?php echo (empty($profilePhoto)?"media/profile_photos/default_photo.svg":$profilePhoto) ?>" id="userimg" alt="">
                        <label class="changeimgicon Formactive" for="profiledp"><img src="img/add_a_photo.svg" class="edit_icon"></label>
                    </div>
                    <input type="file" name="dp" id="profiledp" onchange="ImgPreview()" class="user_info" accept="image/*" disabled>
                </div>
                <div>
                    <label>Full Name</label>
                    <input type="text" name="fname" class="user_info" value="<?php echo $fullname; ?>" disabled>
                </div>
                <div>
                    <label>User Name</label>
                    <input type="text" name="username" value="<?php echo $username; ?>" class="user_info" disabled>
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $email; ?>" class="user_info" disabled>
                </div>
                <div>
                    <label>Address</label>
                    <textarea type="text" name="address" class="user_info" rows="3" cols="30" disabled><?php echo $address; ?></textarea>
                </div>
                <div>
                    <label>Pincode</label>
                    <input type="number" name="pincode" value="<?php echo $pincode; ?>" class="user_info" id="" disabled>
                </div>
            </form>

        </div>

        <!-- sell book page structure -->
        <div class="profile_container">
            <div class="header">
                <h1>Your Books</h1>
            </div>
            <div class="card-container">
                <?php
                $SelectSoldBookQuery = 'SELECT book_id,
                                            book_name,
                                            book_coverpage,
                                            book_description,
                                            (SELECT user_name from user where user_id = btr.seller_id) as sellerId
                                            FROM book_transaction btr
                                            WHERE seller_id = ' . $_SESSION['userID'] . ' AND buyer_id IS NULL';

                $SelectSoldBookFire = mysqli_query($con, $SelectSoldBookQuery);
                $Purchesed = "";

                if (mysqli_num_rows($SelectSoldBookFire) != 0) {
                    while ($SelectSoldBookResult = mysqli_fetch_assoc($SelectSoldBookFire)) {
                        $Purchesed = '  <div class="actionsBtn">
                                                    <button ><img src="img/edit_icon.svg" class="buttonCursor" onclick="EditBookInfo(event,' . $SelectSoldBookResult['book_id'] . ')"></button>
                                                    <button ><img src="img/delete_icon.svg" class="buttonCursor" onclick="DeleteBook(event,' . $SelectSoldBookResult['book_id'] . ')"></button>
                                                </div>';
                        echo  ' <div class="card">
                                        ' . $Purchesed . '
                                        <div class="book-header">
                                            <div class="book-photo">
                                                <img src="' .  (file_exists($SelectSoldBookResult['book_coverpage']) == false ? 'img/logo_with_text.png' : $SelectSoldBookResult['book_coverpage']) . '">
                                            </div>
                                            <div class="book-title">' . $SelectSoldBookResult['book_name'] . '</div>
                                        </div>
                                        <div class="book-body">
                                            <div class="book-details">
                                                <div class="book-description">' . $SelectSoldBookResult['book_description'] . '</div>
                                            </div>
                                            <div class="book-seller-buyer">
                                                <div>
                                                    <span>seller</span>
                                                </div>
                                                <div>
                                                    <span class="book-seller">' . $SelectSoldBookResult['sellerId'] . '</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                    }
                } else {
                    echo "<p class='BookError'>No books for sell from you <a href='SellBook.php'> Sell Book Now</a></p>";
                }
                ?>
            </div>
        </div>

        <!-- sold book page structure -->
        <div class="profile_container">
            <div class="header">
                <h1>Sold Books</h1>
            </div>
            <div class="card-container">
                <?php
                $SelectSoldBookQuery = 'SELECT book_id,
                                            book_name,
                                            book_coverpage,
                                            book_description,
                                            (SELECT user_name from user where user_id = btr.seller_id) as sellerId,
                                            (SELECT user_name from user where user_id = btr.buyer_id) As buyerId,
                                            buyer_id 
                                            FROM book_transaction btr
                                            WHERE seller_id = ' . $_SESSION['userID'] . ' AND buyer_id IS NOT NULL';

                $SelectSoldBookFire = mysqli_query($con, $SelectSoldBookQuery);

                if (mysqli_num_rows($SelectSoldBookFire) != 0) {
                    while ($SelectSoldBookResult = mysqli_fetch_assoc($SelectSoldBookFire)) {
                        echo  ' <div class="card">
                                        <div class="book-header">
                                            <div class="book-photo">
                                                <img src="' . (file_exists($SelectSoldBookResult['book_coverpage']) == false ? 'img/logo_with_text.png' : $SelectSoldBookResult['book_coverpage'])  . '">
                                            </div>
                                            <div class="book-title">' . $SelectSoldBookResult['book_name'] . '</div>
                                        </div>
                                        <div class="book-body">
                                            <div class="book-details">
                                                <div class="book-description">' . $SelectSoldBookResult['book_description'] . '</div>
                                            </div>
                                            <div class="book-seller-buyer">
                                                <div>
                                                    <span>seller</span>
                                                    <span>Buyer</span>
                                                </div>
                                                <div>
                                                    <span class="book-seller">' . $SelectSoldBookResult['sellerId'] . '</span>
                                                    <span class="book-buyer">' . ($SelectSoldBookResult['buyerId'] == "" ? "Not yet" : $SelectSoldBookResult['buyerId']) . '</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                    }
                } else {
                    echo "<p class='BookError'>No books sold yet</p>";
                }
                ?>
            </div>
        </div>

        <!-- Bought book page structure -->
        <div class="profile_container">
            <div class="header">
                <h1>Purchased Book</h1>
            </div>
            <div class="card-container">
                <?php
                $SelectSoldBookQuery = 'SELECT book_name,book_coverpage,book_description,(SELECT fname from user where user_id = btr.seller_id) as sellerId,(SELECT fname from user where user_id = btr.buyer_id) As buyerId 
                                        FROM book_transaction btr WHERE buyer_id = ' . $_SESSION['userID'] . ' ';
                $SelectSoldBookFire = mysqli_query($con, $SelectSoldBookQuery);

                if (mysqli_num_rows($SelectSoldBookFire) != 0) {

                    while ($SelectSoldBookResult = mysqli_fetch_assoc($SelectSoldBookFire)) {
                        echo  '<div class="card">
                                <div class="book-header">
                                    <div class="book-photo">
                                        <img src="' . (file_exists($SelectSoldBookResult['book_coverpage']) == false ? "media/profile_photo/bslogo.jpeg" : $SelectSoldBookResult['book_coverpage']) . '">
                                    </div>
                                    <div class="book-title">' . $SelectSoldBookResult['book_name'] . '</div>
                                </div>
                                <div class="book-body">
                                    <div class="book-details">
                                        <div class="book-description">' . $SelectSoldBookResult['book_description'] . '</div>
                                    </div>
                                    <div class="book-seller-buyer">
                                        <div>
                                            <span>Buyer</span>
                                            <span>seller</span>
                                        </div>
                                        <div>
                                            <span class="book-buyer">' . ($SelectSoldBookResult['buyerId'] == "" ? "Not yet" : $SelectSoldBookResult['buyerId']) . '</span>
                                            <span class="book-seller">' . $SelectSoldBookResult['sellerId'] . '</span>
                                        </div>
                                    </div>
                                </div>
                                    </div>';
                    }
                } else {
                    echo "<p class='BookError'>No books Bought yet <a href='index.php'> Buy Book Now</a></p>";
                }
                ?>
            </div>
        </div>

        <!--    
            error msg structure.
            error will be shown here.
        -->
        <div class="Formactive response">
            <div><img src="img/warning_icon.svg"></div>
            <div class="errorMsg"></div>
        </div>
    </div>

</div>

<?php
require_once "php/footer.php";
?>

</body>
<script src="js/profile.js"></script>
<script src="js/AJAX.js"></script>

</html>