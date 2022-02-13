<?php
if ($_SESSION["role"] == "admin") {
    header("Location: admindashboard.php");
}
$title = "Dachboard - Book sharing";
$css_file_name = "dahboard";
require "php/dbconfig.php";
require "php/navbar.php";
?>

<div id="search_bar">
    <img src="./img/search.png" id="search-icon">
    <input type="search" oninput="search()" id="book-name" name="book-name" placeholder="Search a book">
</div>
<div id="main">
    <?php
    $query = "SELECT * FROM book_transaction";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<a href='#' class='book-container'>" .
                "<div class='bookimg'>" .
                "<img src='" . $row["book_coverpage"] . "'>" .
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
<script src="./js/dashboard.js"></script>
<script src="./js/ajax.js"></script>
</body>

</html>