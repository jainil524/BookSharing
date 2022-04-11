<?php
$title = "Notification - BookSharing";
$css_file_name = "notification";
require "php/dbconfig.php";
require "php/navbar.php";
require "php/LoginCheck.php";
require "php/RoleChecker.php";
Rlchecker("user", 403, "Access Denied", "You don't have access to this page");
Rlchecker("DeliveryGuy", 403, "Access Denied", "You don't have access to this page");
?>

<div id="container">
    <div id="notifications">

        <!-- OTP container -->
        <div class="BookPin subcontainer">
            <?php
                $SelectBookPinQuery = "SELECT book_name,dg.delivery_guy_name dgn,BookPin FROM book_transaction bt INNER JOIN delivery_guy dg ON dg.delivery_guy_id = bt.delivery_guy_id   WHERE buyer_id = " . $_SESSION['userID'];
                $SelectBookPinFire = mysqli_query($con, $SelectBookPinQuery);
                if(mysqli_num_rows($SelectBookPinFire) != 0){
                    while ($SelectBookPinResult = mysqli_fetch_assoc($SelectBookPinFire)) {
                        echo '<div class="card">
                                    <div class="card-img">
                                        <img src="img/BookPin_icon.png" alt="">
                                    </div>
                                    <div class="card-details">
                                        This is your Book Pin <b>' . $SelectBookPinResult['BookPin'] . '</b> for your book <b>'.$SelectBookPinResult['book_name'].'</b> please give to delivery guy <b>'.$SelectBookPinResult['dgn'].'</b> for verification.
                                    </div>
                                    <div class="watermark">Book Pin</div>
                                </div>';
                    }
                }
                ?>
        </div>
        <!-- Warning msgs container -->
        <div class="Warnings subcontainer">
            <?php
                $SelectWaringQuery = "SELECT warning_message FROM warn_user_delivery_guy WHERE warn_user_id = " . $_SESSION['userID'];
                $SelectWaringFire = mysqli_query($con, $SelectWaringQuery);
                if(mysqli_num_rows($SelectWaringFire) != 0){
                    while ($SelectWaringResult = mysqli_fetch_assoc($SelectWaringFire)) {
                        echo '  <div class="card">
                                    <div class="card-img">
                                        <img src="img/warning_icon.svg" alt="">
                                    </div>
                                    <div class="card-details">
                                        ' . $SelectWaringResult['warning_message'] . '
                                    </div>
                                    <div class="watermark">Warning</div>
                                </div>';
                    }
                }
            ?>
        </div>

    </div>
</div>

<?php
require "php/footer.php";
?>