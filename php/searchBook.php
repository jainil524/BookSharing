<?php
require "dbconfig.php";
session_start();

$IsSessionStarted = "";
if (isset($_SESSION['userID'])) {
    $IsSessionStarted = "AND  NOT seller_id = " . $_SESSION["userID"];
}
if (empty($_POST["book-name"])) {
    $query = "SELECT * FROM book_transaction WHERE buyer_id IS NULL " . $IsSessionStarted;
} else {
    $query = "SELECT * FROM book_transaction WHERE buyer_id IS NULL " . $IsSessionStarted . " AND book_name like'%" . $_POST['book-name'] . "%'";
}

$returnString = "";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_array($result)) {
        $returnString .= "<a href='view.php?id=" . $row['book_id'] . "' class='book-container'>" .
            "<div class='bookimg'>" .
            "<img src='" . (file_exists('../' . $row["book_coverpage"]) == false ? '../img/logo_with_text.png' : $row["book_coverpage"]) . "'>" .
            "</div>" .
            "<div class='description'>" .
            "<h4 class='book-name'>" . $row['book_name'] . "</h4>" .
            "<h5 class='author'><span>Author: </span>" . $row["book_author"] . "</h5>" .
            "<h5 class='publisher'><span>Publish: </span> " . $row["book_publish_year"] . "</h5>" .
            "<h5 class='ruppes'><span>&#8377;</span> " . $row["book_price"] . "</h5>" .
            "</div>" .
            "</a>";
    }
}

echo empty($returnString) ? "<h2 class='error'> No Book For Sell</h2>" : $returnString;
