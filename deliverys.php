<?php
$title = "Delivery - BookSharing";
$css_file_name = "user";
require "php/dbconfig.php";
require "php/navbar.php";
require "php/LoginCheck.php";
require "php/RoleChecker.php";
Rlchecker("DeliveryGuy", 403, "Access Denied", "You don't have access to this page");
?>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

<div id="main">
    <h3 class="titleofpage"> Delivery </h3>
    <table class="mytable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Pick from</th>
                <th>drop to</th>
                <th>Seller</th>
                <th>Buyer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT book_id,book_name,seller_id , buyer_id,
                        (SELECT `address` FROM user WHERE user_id = bt.seller_id) as pickaddr ,
                        (SELECT `address` FROM user WHERE user_id = bt.buyer_id) as dropaddr,
                        (SELECT user_name FROM user WHERE user_id = bt.seller_id) as seller,
                        (SELECT user_name FROM user WHERE user_id = bt.buyer_id) as buyer   
                        FROM book_transaction bt 
                        WHERE IsDelivered = 0 AND delivery_guy_id = " . $_SESSION['userID'];
            $userResult = mysqli_query($con, $query);
            $no = 1;
            if (mysqli_num_rows($userResult) != 0) {
                while ($user = mysqli_fetch_assoc($userResult)) {
                    echo '<tr>
                        <td>' . $no . '</td>
                        <td>' . $user["book_name"] . '</td>
                        <td>' . $user["pickaddr"] . '</td>
                        <td >' . $user['dropaddr'] . '</td>
                        <td>' . $user['seller'] . '</td>
                        <td>' . $user['buyer'] . '</td>
                        <td><button style="background:var(--logoColor);color:white;padding:.3rem 1rem;border:1px solid var(--logocolorlight);border-radius:5px;" onclick="VerifyByOtp(event,'.$user['book_id'].','.$user['seller_id'].')" class="buttonCursor">Verify</button></td>
                    </tr>';
                    $no++;
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script src=" js/jquery.min.js"></script>
<script src="js/jquery.steps.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<?php include "php/footer.php"; ?>

<script src="js/user.js"></script>
</body>

</html>