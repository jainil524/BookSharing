<?php
$title = "Book - Book sharing";
$css_file_name = "user";
require "php/LoginCheck.php";
require "php/RoleChecker.php";
Rlchecker("admin", 403, "Access Denied", "You don't have access to this page");

require "php/dbconfig.php";
require "php/navbar.php";
?>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<h3 class="titleofpage"> List of All Books</h3>

<div id="main">
    <table class="mytable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Author</th>
                <th>Publish Year</th>
                <th>Book Description</th>
                <th>Seller</th>
                <th>Buyer</th>
                <th>Uploaded</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT *,(SELECT user_name FROM user WHERE user_id = seller_id) AS seller,(SELECT user_name FROM user WHERE user_id = buyer_id) AS buyer FROM `book_transaction`";
            $bResult = mysqli_query($con, $query);

            if (mysqli_num_rows($bResult)) {
                while ($b = mysqli_fetch_assoc($bResult)) {
                    echo '<tr>
                            <td>' . $b["book_id"] . '</td>
                            <td>' . $b["book_name"] . '</td>
                            <td>' . $b["book_price"] . '</td>
                            <td>' . $b["book_author"] . '</td>
                            <td>' . $b["book_publish_year"] . '</td>
                            <td>' . $b["book_description"] . '</td>
                            <td>' . $b["seller"] . '</td>
                            <td>' . ($b["buyer"] == "" ? "Not Buyed" : $b["buyer"]) . '</td>

                            <td>' . $b["upload_time"] . '</td>
                            <td><img src="img/delete_icon.svg" onclick="RemoveBook(event,' . $b['book_id'] . ')" class="buttonCursor"></td>
                        </tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>
<?php require "php/footer.php"; ?>

<script src="js/jquery.min.js"></script>
<script src="js/jquery.steps.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="js/user.js"></script>
</body>

</html>