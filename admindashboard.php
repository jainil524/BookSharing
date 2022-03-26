<?php
$title = "Admin Dachboard - Book sharing";
$css_file_name = "adminDashboard";
require "php/LoginCheck.php";
require "php/RoleChecker.php";
Rlchecker("admin", 403, "Access Denied", "You don't have permission the this page");

require "php/dbconfig.php";
require "php/navbar.php";
?>
<div class="main">

    <!-- Header section -->
    <div id="header">

        <?php
        $StaticsticQuery = "SELECT COUNT(user_id) As userCount,
                                (SELECT COUNT(Book_id) FROM book_transaction WHERE buyer_id IS NOT NULL) As SoldBookCount,
                                (SELECT COUNT(Book_id) FROM book_transaction WHERE buyer_id IS  NULL) As AvailableBookCount,
                                (SELECT COUNT(delivery_guy_id) FROM delivery_guy WHERE status = 0) As DeliveryGuyCount,
                                (SELECT SUM(book_price)*5/100 FROM book_transaction WHERE buyer_id IS NOT NULL) As TotalRevenue
                                FROM user 
                                WHERE IsRestricted = 0";

        $StaticsticFire = mysqli_query($con, $StaticsticQuery);
        $StaticsticResult = mysqli_fetch_assoc($StaticsticFire);

        ?>
        <!-- users info -->
        <div class="info-card">
            <div class="details">
                <span class="numbers"><?php echo $StaticsticResult['userCount'] ?></span>
                <span class="title">Users</span>
            </div>
            <div class="info-card-img">
                <img src="media/profile_photos/default_photo.svg" alt="user photo">
            </div>
        </div>

        <!-- delivery guy info -->
        <div class="info-card">
            <div class="details">
                <span class="numbers"><?php echo $StaticsticResult['DeliveryGuyCount'] ?></span>
                <span class="title">Delivery Guy</span>
            </div>
            <div class="info-card-img">
                <img src="img/courier_icon.svg" alt="user photo">
            </div>
        </div>

        <!-- Available books info -->
        <div class="info-card">
            <div class="details">
                <span class="numbers"><?php echo $StaticsticResult['AvailableBookCount'] ?></span>
                <span class="title">Available Books</span>
            </div>
            <div class="info-card-img">
                <img src="img/book_icon.svg" alt="user photo">
            </div>
        </div>

        <!-- Sold books info -->
        <div class="info-card">
            <div class="details">
                <span class="numbers"><?php echo $StaticsticResult['SoldBookCount'] ?></span>
                <span class="title">Sold Books</span>
            </div>
            <div class="info-card-img">
                <img src="img/book_icon.svg" alt="user photo">
            </div>
        </div>

        <!-- revenue info -->
        <div class="info-card">
            <div class="details">
                <span class="numbers" title="<?php echo number_format($StaticsticResult['TotalRevenue']); ?>"><?php echo number_format($StaticsticResult['TotalRevenue']); ?></span>
                <span class="title">Revenue</span>
            </div>
            <div class="info-card-img">
                <img src="img/money_icon.png" alt="money icon">
            </div>
        </div>
    </div>

    <!-- container for user , delivery , reports -->
    <div id="list-container">

        <!-- users list both -->
        <div id="usersList">
            <h4>Users</h4>

            <?php
            $SelectUserQuery = "SELECT user_name,email,profile_photo FROM user WHERE IsRestricted = 0 LIMIT 5";
            $SelectUserFire = mysqli_query($con, $SelectUserQuery);
            if (mysqli_num_rows($SelectUserFire) != 0) {
                while ($SelectUserResult = mysqli_fetch_assoc($SelectUserFire)) {
                    echo '<div class="user-card">
                                    <div class="user-profile-img">
                                        <img src="' . (file_exists($SelectUserResult['profile_photo']) == false ? 'media/profile_photos/default_photo.svg' : $SelectUserResult['profile_photo'])  . '" alt="user img">
                                    </div>
                                    <div class="user-info">
                                        <span class="username">' . $SelectUserResult['user_name'] . '</span>
                                        <span class="email">' . $SelectUserResult['email'] . '</span>
                                    </div>
                                </div>
                                ';
                }
            } else {
                echo 'No Users Yet';
            }

            ?>
            <a href="user.php">More Details</a>
        </div>

        <!-- Delivery and report both -->
        <div id="delivery_report">

            <!-- Delivery and report both -->
            <div class="deliveryGuyList">
                <h4>Delivery Guys</h4>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date of birth</th>
                    </tr>
                    <?php
                    $SelectDeliveryQuery = "SELECT delivery_guy_name,delivery_guy_email,delivery_guy_dob FROM delivery_guy WHERE status = 0  LIMIT 4";
                    $SelectDeliveryFire = mysqli_query($con, $SelectDeliveryQuery);
                    if (mysqli_num_rows($SelectDeliveryFire) != 0) {
                        while ($SelectDeliveryResult = mysqli_fetch_assoc($SelectDeliveryFire)) {
                            echo '<tr>
                                    <td>' . $SelectDeliveryResult['delivery_guy_name'] . '</td>
                                    <td>' . $SelectDeliveryResult['delivery_guy_email'] . '</td>
                                    <td>' . $SelectDeliveryResult['delivery_guy_dob'] . '</td>
                                </tr>';
                        }
                    } else {
                        echo '<tr><td></td><td>No Delivery Guy  yet</td><td></td></tr>';
                    }
                    ?>

                </table>
                <a href="deliveryGuys.php">More Details</a>
            </div>

            <!-- Delivery and report both -->
            <div class="reportsList">
                <h4>Reports</h4>
                <table>
                    <tr>
                        <th>Reporter</th>
                        <th>Reported</th>
                        <th>Reason</th>
                    </tr>
                    <?php
                    $SelectReportQuery = "SELECT (SELECT user_name FROM user WHERE user_id = reporter_user) As repoerter,(SELECT user_name FROM user WHERE user_id = reported_user) As repoertedUser,Report_msg FROM reports LIMIT 3";
                    $SelectReportFire = mysqli_query($con, $SelectReportQuery);
                    if (mysqli_num_rows($SelectReportFire) != 0) {
                        while ($SelectReportResult = mysqli_fetch_assoc($SelectReportFire)) {
                            echo '<tr>
                                            <td>' . $SelectReportResult['repoerter'] . '</td>
                                            <td>' . $SelectReportResult['repoertedUser'] . '</td>
                                            <td>' . $SelectReportResult['Report_msg'] . '</td>
                                        </tr>';
                        }
                    } else {
                        echo '<tr><td></td><td>No Reports yet</td><td></td></tr>';
                    }
                    ?>
                </table>
                <a href="reports.php">More Details</a>
            </div>
        </div>
    </div>
</div>
<?php
require "php/footer.php";
?>
</body>

<!-- 
Header
1)Total revenew
2)Number of user
3)Number of Sold Book
4)Number of Available Books
5)Numeer Of Delivery guy


Body
->Delivery guy & reports section

->User 


 -->