<?php
$title = "Sell Book - Book sharing";
$css_file_name = "SellBook";

require "php/navbar.php";
require "php/dbconfig.php";
require "php/LoginCheck.php";
?>
<div class="sell-container">
  <div class="container">
    <div class="title">Sell Book</div>
    <div class="content">
      <?php
      if (isset($_GET['Bid'])) {
        global $con;
        $EditDBookInfoQuery = "SELECT * FROM book_transaction bt WHERE bt.book_id=" . $_GET['Bid'] . " AND bt.seller_id = " . $_SESSION['userID'] . "";
        // echo $EditDBookInfoQuery;
        // exit();
        $EditDBookInfoFire = mysqli_query($con, $EditDBookInfoQuery);
        $EditDBookInfoResult = mysqli_fetch_assoc($EditDBookInfoFire);
      }
      ?>
      <form action="#" onsubmit="return false" id="sell-form" enctype="multipart/form-data">
        <input type="hidden" name="Isedited" value="<?php echo (isset($_GET['Bid']) == true ? $_GET['Bid'] : "") ?>">
        <div class="user-details">
          <div class="input-box">
            <span class="details"> Cover Image
              <input type="file" name="coverimg" id="UploadCover" style="display: block;" title="Upload Cover Page of Book">
            </span>
          </div>

          <div class="input-box">
            <span class="details"> Name
              <input type="text" name="bname" placeholder="Ex. Python For Beginners" value="<?php echo (isset($EditDBookInfoResult['book_name']) == true ? $EditDBookInfoResult['book_name'] : "") ?>">
            </span>
          </div>

          <div class="input-box">
            <span class="details"> Author
              <input type="text" name="bauthor" placeholder="Ex. Dhruv Raval" value="<?php echo (isset($EditDBookInfoResult['book_author']) == true ? $EditDBookInfoResult['book_author'] : "") ?>">
            </span>
          </div>

          <div class="input-box">
            <span class="details"> Category
              <select name="category">
                <option value="#">Select Category</option>
                <?php
                  $SelectCategoryQuery = "SELECT * FROM category";
                  $SelectCategoryFire = mysqli_query($con,$SelectCategoryQuery);
                    while($SelectCategoryResult = mysqli_fetch_assoc($SelectCategoryFire)){
                      echo '<option value="'.$SelectCategoryResult['category_id'].'">'.$SelectCategoryResult['category_type'].'</option>';
                    }
                ?>
              </select>
            </span>
          </div>

          <div class="input-box">
            <span class="details">Publish Year
              <input type="number" min="1900" max="2022" placeholder="Ex. <?= date("Y")?>" name="byear" value="<?php echo (isset($EditDBookInfoResult['book_publish_year']) == true ? $EditDBookInfoResult['book_publish_year'] : "") ?>">
            </span>
          </div>

          <div class="input-box">
            <span class="details"> Price
              <input type="number" name="bprice" placeholder="Ex. 50" value="<?php echo (isset($EditDBookInfoResult['book_price']) == true ? $EditDBookInfoResult['book_price'] : "") ?>">
            </span>
          </div>

          <div class="input-box textAreaBox">
            <span class="details"> Description
              <textarea name="bdesc" cols="30" rows="10" placeholder="Ex. It provides a clear, easy to follow, introduction to Python programming."><?php echo (isset($EditDBookInfoResult['book_description']) == true ? $EditDBookInfoResult['book_description'] : "") ?></textarea>
            </span>
          </div>
        </div>

        <div class="button">
          <input type="submit" onclick="sellBook()" name="Sell" id="submit" value="Sell">
        </div>

        <div class="input-box" id="error"></div>
      </form>
    </div>
  </div>
</div>
<?php include_once "php/footer.php"; ?>
<script src="./js/sellBook.js"></script>
</body>

</html>