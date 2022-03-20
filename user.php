<?php
$title = "Users - Book sharing";
$css_file_name = "user";
require "php/LoginCheck.php";
require "php/RoleChecker.php";
Rlchecker("admin", 403, "Access Denied", "You don't have access to this page");

require "php/dbconfig.php";
require "php/navbar.php";
?>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

<div id="main">
    <h3 class="titleofpage"> Users</h3>
    <table class="mytable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT user_id, user_name,email,IsRestricted  FROM user ORDER BY IsRestricted DESC";
            $userResult = mysqli_query($con, $query);
            $no = 1;
            if (mysqli_num_rows($userResult) != 0) {
                while ($user = mysqli_fetch_assoc($userResult)) {
                    echo '<tr>
                        <td>' . $no . '</td>
                        <td>' . $user["user_name"] . '</td>
                        <td>' . $user["email"] . '</td>
                        <td class="status">' . ($user["IsRestricted"] == 0 ? "Active" : "Deactive") . '</td>
                        <td>
                            <div class="actionBtn ">
                                <img class="buttonCursor" title="Restrict user" src="img/restrict_icon.svg" onclick="restrictUser(event,' . $user["user_id"] . ',`' . $user["user_name"] . '`)">
                                <img class="buttonCursor" title="Warn user" src="img/warning_icon.svg"  onclick="warnUser(' . $user["user_id"] . ')">
                            </div>
                        </td>
                    </tr>';
                    $no++;
                }
            }
            ?>
        </tbody>
    </table>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/jquery.steps.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<?php include "php/footer.php"; ?>

<script src="js/user.js"></script>
</body>

</html>