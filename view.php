<?php
$title = "View - Book sharing";
$css_file_name = "view";

require "php/dbconfig.php";
require "php/navbar.php";

$select_book_query = "SELECT *,(SELECT category_type FROM category WHERE category_id = bl.category_id) AS category FROM book_transaction bl LEFT JOIN user ON bl.seller_id = user.user_id WHERE book_id = " . $_GET["id"];
$fire_query = mysqli_query($con, $select_book_query);
$book = mysqli_fetch_assoc($fire_query);

if (empty($book) || isset($book["buyer_id"])) {
    $erro_code = 404;
    $erro_title = "Opps! Book Not Found...";
    $erro_desc = "Sorry Book is not found someone buyed or removed by seller";
    require "php/error.php";
} else {
?>
    <div>
        <div class="main-con">
            <div class="back-btn">
                <a href="index.php"><img src="./img/back.png" alt=""></a>
            </div>

            <div class="book-container">
                <div class="img-con">
                    <img src="<?php echo (file_exists($book["book_coverpage"]) == false ? 'img/logo_with_text.png' : $book["book_coverpage"]); ?>" alt="book_img">
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

                    <div class="author">
                        <h5>Category:</h5>
                        <h3><?php echo $book["category"]; ?></h3>
                    </div>

                    <div class="publisher">
                        <h5>Publisher year:</h5>
                        <h3><?php echo $book["book_publish_year"]; ?></h3>
                    </div>
                    <div class="author">
                        <h5>Price:</h5>
                        <h3>&#8377; <?php echo $book["book_price"]; ?></h3>
                    </div>
                    <div class="btn-container">
                        <button onclick="buy(<?php echo (isset($_SESSION['userID']) ? $_SESSION['userID'] : '') ?>)">Buy</button>
                    </div>
                    <div class="seller-detail">
                        <h5>Seller:</h5>
                        <h3><?php echo $book["user_name"]; ?>
                            <span class="option" onclick="openPopUp(event)">...</span>
                        </h3>
                    </div>
                    <div class="error">
                        <h5></h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="rc">
            <div class="rc-container">
                    <a class="chat" href="chat.php?+<?php echo $book["user_id"]; ?>">
                        <div class="chat-img">
                            <img src="img/chat.png" alt="Chat">
                        </div>
                        <span>Chat</span>
                    </a>

                <div class="report" onclick="showReport(<?php echo (isset($_SESSION['userID']) ? $_SESSION['userID'] : ''); ?> )">
                    <div class="report-tmg">
                        <img src="img/report.png" alt="report">
                    </div>
                    <span>Report</span>
                </div>
            </div>
        </div>

        <div class="report-pop-up" onclick="closePopup(event)">
            <div class="pop-up">
                <div class="heading"> Report to <span><?php echo $book["user_name"]; ?></span> </div>
                <div class="reason-con">
                    <div class="wrapper">
                        <input type="radio" name="report_reson" value="Harassment or bullying" id="r1">
                        <label for="r1">Harassment or bullying</label>
                    </div>
                    <div class="wrapper">
                        <input type="radio" name="report_reson" value="Harmful or dangerous acts" id="r2">
                        <label for="r2">Harmful or dangerous acts</label>
                    </div>
                    <div class="wrapper">
                        <input type="radio" name="report_reson" value="Child abuse" id="r3">
                        <label for="r3">Child abuse</label>
                    </div>
                    <div class="wrapper">
                        <input type="radio" name="report_reson" value="Spam or misleading" id="r4">
                        <label for="r4">Spam or misleading</label>
                    </div>
                    <div class="wrapper">
                        <input type="radio" name="report_reson" value="Infringes my rights" id="r5">
                        <label for="r5">Infringes my rights</label>
                    </div>
                    <div class="wrapper">
                        <input type="radio" name="report_reson" value="Violent or repulsive content" id="r6">
                        <label for="r6">Violent or repulsive content</label>
                    </div>
                </div>
                <button onclick="report(<?php echo $book['user_id'] ?>)">Report</button>
            </div>
        </div>
    </div>

<?php }
include_once "php/footer.php"; ?>
<script src="js/AJAX.js"></script>
<script src="./js/view.js"></script>