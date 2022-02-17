<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/common.css">
    <link rel="stylesheet" href="asset/css/add.css">
    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/state.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Action</title>
</head>
<?php
session_start();
require 'php/dbconfig.php';
if (!$con) {
    die("con failed: ");
} else {
    $raw['delivery_guy_name'] = "";
    $raw['delivery_guy_email'] = "";
    $raw['delivery_guy_id'] = "0";
    $raw['delivery_guy_id'] = "";
    $raw['delivery_guy_address'] = "";
    $raw['delivery_guy_password'] = "";
    $raw['delivery_guy_pincode'] = "";


    if (isset($_GET['id'])) {

        $_SESSION['editdg'] = $_GET['id'];

        $selectquery = "select * from delivery_guy
                        where delivery_guy_id = " . $_GET['id'];
        $result = mysqli_query($con, $selectquery);
        $raw = mysqli_fetch_assoc($result);

    } elseif (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $did = $_POST['did'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $addr = $_POST['addr'];
        $status = $_POST['status'];
        $pincode = $_POST['zipcode'];
        $pass = $_POST['pass'];
//New   
        //$pass = md5($pass);

        if (isset($_POST['edit'])) {
            $updatequery = "UPDATE delivery_guy AS d SET 
                                d.delivery_guy_id = " . $did . ",
                                d.delivery_guy_name = '" . $name . "',
                                d.delivery_guy_email = '" . $email . "',
                                d.delivery_guy_dob = '" . $dob . "',
                                d.delivery_guy_address = '" . $addr . "',
                                d.status = " . $status . ",
                                d.delivery_guy_pincode = " . $pincode . ",
                                d.delivery_guy_password = '" . $pass . "'
                            WHERE d.delivery_guy_id = " . $_SESSION['editdg'];
            if (mysqli_query($con, $updatequery)) {
                echo "<script>alert('" . $name . " record updated successfully'); window.close();</script>";
            } else {
                echo "Error1: " . $updatequery . "<br>" . mysqli_error($con);
            }
        } else {
            $query = "INSERT INTO `delivery_guy`(`delivery_guy_id`, `delivery_guy_name`, `delivery_guy_email`, `delivery_guy_dob`, `status`, `delivery_guy_address`,`delivery_guy_pincode`, `delivery_guy_password`) 
            VALUES ($did,'$name','$email','$dob',1,'$addr',$pincode,'$pass') ";
            if (mysqli_query($con, $query)) {
                echo "<script>alert('" . $name . " record created successfully'); window.close();</script>";
            } else {
                echo "Error1: " . $query . "<br>" . mysqli_error($con);
            }
        }
    }
}
?>

<body>
    <div class="container">

        <form action="action.php" method="post">
            <div class="form-group">
                <label for="name">NAME</label> <input type="text" value="<?php echo $raw['delivery_guy_name']; ?>" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" required>

            </div>
            <?php
            if (isset($_GET['id'])) {
                echo '<input type="hidden" name="edit" value="TRUE" >';
                $deliveryguy_Id = $raw['delivery_guy_id'];
            } else {
                $selectquery = "SELECT d.delivery_guy_id+1 as deliveryguy_Id FROM delivery_guy d ORDER BY d.delivery_guy_id DESC LIMIT 1";
                $result = mysqli_query($con, $selectquery);
                $newraw = mysqli_fetch_assoc($result);

                $deliveryguy_Id = $newraw['deliveryguy_Id'];
            }
            ?>
            <div class="form-group">
                <label for="did">ID</label> <input type="number" value="<?php echo $deliveryguy_Id; ?>" name="did" class="form-control" id="exampleInputPassword1" min="0" placeholder="ID" readonly required>
            </div>
            <div class="form-group">
                <label for="email">EMAIL</label>
                <input type="email" value="<?php echo $raw['delivery_guy_email']; ?>" name="email" class="form-control" id="exampleInputPassword1" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="dob">DOB</label> <input type="date" value="<?php echo $raw['delivery_guy_dob']; ?>" name="dob" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="addr">Address</label>
                <input type="text" value="<?php echo $raw['delivery_guy_address']; ?>" name="addr" class="form-control" id="exampleInputPassword1" placeholder="Address" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>

                <select name="status" style='width: 45%;' class='form-control' name='status' value="">
                    <option value="">SELECT STATUS</option>
                    <?php
                    $statusisset = "";
                    if ($raw['status'] == 1 || $raw['status'] == 0 && isset($_GET['id'])) {
                        $statusisset = 'selected="selected"';
                        // echo '<option value="1" selected="selected">Active</option>';
                    }


                    ?>
                    <option value="1" <?php echo $statusisset; ?>>Active</option>
                    <option value="0" <?php echo $statusisset; ?>>Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pass">PASSWORD</label>
                <input type="password" value="<?php echo $raw['delivery_guy_password']; ?>" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
            </div>

            <div class="form-group"><label for="zipcode">PINCODE</label>
                <input type="text" value="<?php echo $raw['delivery_guy_pincode']; ?>" name="zipcode" class="form-control" id="pincode" placeholder="Pincode" required>
            </div>
            <input type="submit" name="submit" value="save" class="btn btn-primary">

        </form>

    </div>
    <script>
        window.onunload = refreshParent;

        function refreshParent() {
            window.opener.location.reload();
        }
    </script>
</body>

</html>