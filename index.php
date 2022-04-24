<?php
$title = "Dashboard - Book sharing";
$css_file_name = "dashboard";

require "php/dbconfig.php";
require "php/navbar.php";
if (isset($_SESSION['uesrID']) && (isset($_SESSION["role"]) && $_SESSION["role"] == "admin")) {
    header("Location: admindashboard.php");
}

?>
<div class="dashboard">
    <div id="search_bar">
        <div>
            <img src="./img/search.png" id="search-icon">
            <input type="search" oninput="search()" id="book-name" name="book-name" placeholder="Search a book">
        </div>
        <div class="filtercon">
            <div class="filterRemove">
                <span class="Category_name"></span>
                <span class="remIcon buttonCursor"><img src="img/close.svg"  onclick="RemoveCategory()"></span>
            </div>
            <div class="filterIcon">
                <img src="img/filter_icon.svg" class="buttonCursor">
            </div>
            <div class="filterOptions">
                <?php
                    $SelectCategoriesQuery = "SELECT * FROM category";
                    $SelectCategoriesFire = mysqli_query($con,$SelectCategoriesQuery);
                    while($SelectCategoriesResult = mysqli_fetch_assoc($SelectCategoriesFire)){
                        echo '<span class="buttonCursor" onclick="Category(`'.$SelectCategoriesResult['category_type'].'`)">'.$SelectCategoriesResult['category_type'].'</span>';
                    }
                ?>
            </div>
        </div>
    </div>
    <div id="main">
        <?php
        $IsSessionStarted = "";
        if (isset($_SESSION['userID'])) {
            $IsSessionStarted = "AND  NOT seller_id = " . $_SESSION["userID"];
        }

        $query = "SELECT book_id,
                    book_name,
                    book_coverpage,
                    book_author,
                    book_publish_year,
                    book_price,
                    category_id,
                    (SELECT category_type FROM category WHERE category.category_id = book_transaction.category_id) AS category
                    FROM book_transaction 
                    WHERE buyer_id IS NULL ${IsSessionStarted} LIMIT 100";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<a href='view.php?id=" . $row["book_id"] . "' class='book-container' data-category=".$row['category'].">" .
                    "<div class='bookimg'>" .
                    "<img src='" . (file_exists($row["book_coverpage"]) == false ? 'img/logo_with_text.png' : $row["book_coverpage"]) . "'>" .
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


