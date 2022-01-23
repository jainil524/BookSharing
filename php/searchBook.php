<?php
require "dbconfig.php";

if (empty($_POST["book-name"])) {
    $query = "SELECT * FROM book_transaction";
} else {
    $query = "SELECT * FROM book_transaction WHERE book_name like'%" . $_POST['book-name'] . "%'";
}

$returnString = "";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_array($result)) {
        $returnString .= "<a href='#' class='book-container'>" .
            "<div class='bookimg'>" .
            "<img src='" . $row["book_coverpage"] . "'>" .
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

echo empty($returnString) ? "<h2 style='width: 100vw; text-align: center; background-color: #d57777;'> No Book Found</h2>" : $returnString;
