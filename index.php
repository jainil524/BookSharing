<?php
$title = "Dachboard - Book sharing";
$css_file_name = "dahboard";

require "php/dbconfig.php";
require "php/navbar.php";
require "php/LoginCheck.php";
if ($_SESSION["role"] == "admin") {
    header("Location: admindashboard.php");
}

if (!isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
    header("Location: admindashboard.php");
}
?>
<div class="dashboard">
    <div id="search_bar">
        <img src="./img/search.png" id="search-icon">
        <input type="search" oninput="search()" id="book-name" name="book-name" placeholder="Search a book">
    </div>
    <div id="main">
        <?php
        $query = "SELECT * FROM book_transaction WHERE buyer_id IS NULL AND  NOT seller_id =" . $_SESSION["userID"];
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<a href='view.php?id=" . $row["book_id"] . "' class='book-container'>" .
                    "<div class='bookimg'>" .
                    "<img src='" . (file_exists($row["book_coverpage"]) == false ? 'img/logos.png' : $row["book_coverpage"]) . "'>" .
                    "</div>" .
                    "<div class='description'>" .
                    "<h4 class='book-name'>" . $row['book_name'] . "</h4>" .
                    "<h5 class='author'><span>Author: </span>" . $row["book_author"] . "</h5>" .
                    "<h5 class='publisher'><span>Publish: </span>" . $row["book_publish_year"] . "</h5>" .
                    "<h5 class='ruppes'><span>&#8377;</span>" . $row["book_price"] . "</h5>" .
                    "</div>" .
                    "</a>";
            }
        } else {
            echo "<h1 class='error'>No Book For Sell</h1>";
        }
        ?>
    </div>
</div>
<?php include_once "php/footer.php"; ?>
<script src="./js/dashboard.js"></script>
<script src="./js/ajax.js"></script>
</body>

</html>