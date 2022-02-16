<?php
$title = "View - Book sharing";
$css_file_name = "view";

require "php/dbconfig.php";
require "php/LoginCheck.php";
require "php/navbar.php";
$select_book_query = "SELECT * FROM book_transaction LEFT JOIN user ON book_transaction.seller_id = user.user_id WHERE book_id = " . $_GET["id"];
$fire_query = mysqli_query($con, $select_book_query);
$book = mysqli_fetch_assoc($fire_query);
if (empty($book)) {
    $erro_title = "Opps! Book Not Found...";
    $erro_desc = "Sorry Book is not found someone buyed or removed by seller";
    require "php/error.php";
    exit;
}
?>
<div class="book-container">
    <div class="img-con">
        <img src="<?php echo $book["book_coverpage"]; ?>" alt="book_img">
    </div>
    <div class="info-container">
        <h2><?php echo $book["book_name"]; ?></h2>
        <div class="author">
            <p><?php echo $book["book_description"]; ?></p>
        </div>
        <div class="author">
            <h5>Author:</h5>
            <h3><?php echo $book["book_author"]; ?></h3>
        </div>
        <div class="publisher">
            <h5>Publisher year:</h5>
            <h3><?php echo $book["book_publish_year"]; ?></h3>
        </div>
        <div class="author">
            <h5>Price:</h5>
            <h3><?php echo $book["book_price"]; ?></h3>
        </div>
        <div class="btn-container">
            <button>Buy</button>
        </div>
        <div class="seller-detail">
            <h5>Seller:</h5>
            <h3><?php echo $book["user_name"]; ?></h3>
        </div>
    </div>
</div>