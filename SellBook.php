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
        if(isset($_GET['Bid'])){
          global $con;
          $EditDBookInfoQuery = "SELECT * FROM book_transaction WHERE book_id=".$_GET['Bid']." AND seller_id = ".$_SESSION['userID'];
          $EditDBookInfoFire = mysqli_query($con,$EditDBookInfoQuery);

          $EditDBookInfoResult = mysqli_fetch_assoc($EditDBookInfoFire);

        }
      ?>
      <form action="#" onsubmit="return false" id="sell-form" enctype="multipart/form-data">
      <input type="hidden" name="Isedited" value="<?php echo (isset($_GET['Bid'])==true?$_GET['Bid']:"") ?>">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Book Cover Image
              <input type="file" name="coverimg" id="UploadCover" style="display: block;" value="<?php echo (isset($EditDBookInfoResult['book_coverpage'])==true?$EditDBookInfoResult['book_coverpage']:"");?>" accept="image/x-png,image/gif,image/jpeg">
            </span>
          </div>

          <div class="input-box">
            <span class="details">Book Name
              <input type="text" name="bname" id="" value="<?php echo (isset($EditDBookInfoResult['book_name'])==true ? $EditDBookInfoResult['book_name'] : "")?>">
            </span>
          </div>

          <div class="input-box">
            <span class="details">Book Author
              <input type="text" name="bauthor" id="" value="<?php echo (isset($EditDBookInfoResult['book_author']) == true ? $EditDBookInfoResult['book_author'] : "")?>">
            </span>
          </div>

          <div class="input-box">
            <span class="details">Publish Year
              <input type="number" min="1900" max="2022" name="byear" id="" value="<?php echo (isset($EditDBookInfoResult['book_publish_year'])==true ? $EditDBookInfoResult['book_publish_year'] : "")?>">
            </span>
          </div>

          <div class="input-box">
            <span class="details">Book Price
              <input type="number" name="bprice" id="" value="<?php echo (isset($EditDBookInfoResult['book_price'])==true?$EditDBookInfoResult['book_price']:"")?>">
            </span>
          </div>

          <div class="input-box">
            <span class="details">Book Description
              <textarea name="bdesc" cols="30" rows="10"><?php echo (isset($EditDBookInfoResult['book_description'])==true?$EditDBookInfoResult['book_description']:"")?></textarea>
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