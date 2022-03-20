<?php
$title = "Delivery Guy - Book sharing";
$css_file_name = "user";
require "php/LoginCheck.php";
require "php/RoleChecker.php";
Rlchecker("admin", 403, "Access Denied", "You don't have permission the this page");

require "php/dbconfig.php";
require "php/navbar.php";
?>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

<div id="main">
    <div class="delivery-title">
        <h3 class="titleofpage">All Delivery Guy</h3>
        <input type="button" value="ADD GUY" onclick="window.open('action.php','popUpWindow','height=500,width=800px,left=250,top=100,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=no')" class="add">
    </div>
    <table class="mytable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT *  FROM delivery_guy";
            $dgResult = mysqli_query($con, $query);

            if (mysqli_num_rows($dgResult)) {
                while ($dg = mysqli_fetch_assoc($dgResult)) {
                    echo '<tr>
                        <td>' . $dg["delivery_guy_id"] . '</td>
                        <td>' . $dg["delivery_guy_name"] . '</td>
                        <td>' . $dg["delivery_guy_email"] . '</td>
                        <td>' . date("d-m-Y", strtotime($dg["delivery_guy_dob"])) . '</td>
                        <td>' . $dg["delivery_guy_address"] . ', ' . $dg["delivery_guy_pincode"] . '</td>
                        <td>' . ($dg["status"] == 1 ? "Active" : "Deactive") . '</td>
                        <td>
                        <span>
                        <button onclick="addemployee(' . $dg["delivery_guy_id"] . ')" class="edit"> EDIT </button><br/>
                    </span>
                        </td>
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
<script>
    function addemployee(id) {
        window.open('action.php?id=' + id, 'popUpWindow', 'height=500,width=800px,left=250,top=100,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=no');
    }
</script>
</body>

</html>