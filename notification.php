<?php
$title = "Notification - BookSharing";
$css_file_name = "notification";

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
            <div>
            </div>
            <div class="card">
                <div class="card-img">
                    <img src="img/BookPin_icon.png" alt="">
                </div>
                <div class="card-details">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, laborum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae cupiditate voluptatem atque sequi laborum, nisi fugit magnam! Facere iure sed sequi possimus error voluptatibus quisquam? Aliquid nisi accusantium aperiam voluptatibus, sequi perferendis dolore quis, aut veritatis repellat doloremque non delectus.
                </div>
                <div class="watermark">Book Pin</div>

            </div>
        </div>

        <!-- Warning msgs container -->
        <div class="Warnings subcontainer">
            <div class="card">
                <div class="card-img">
                    <img src="img/warning_icon.svg" alt="">
                </div>
                <div class="card-details">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, laborum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae cupiditate voluptatem atque sequi laborum, nisi fugit magnam! Facere iure sed sequi possimus error voluptatibus quisquam? Aliquid nisi accusantium aperiam voluptatibus, sequi perferendis dolore quis, aut veritatis repellat doloremque non delectus.
                </div>
                <div class="watermark">Warnings</div>
            </div>
        </div>

    </div>
</div>

<?php
require "php/footer.php";
?>