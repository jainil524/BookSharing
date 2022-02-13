<?php
$title = "Users - Book sharing";
$css_file_name = "user";
require "php/dbconfig.php";
require "php/navbar.php";
?>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<div id="main">
    <table class="mytable">
        <thead>
            <tr>
                <th>Sr no</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT *  FROM delivery_guy";
            $userResult = mysqli_query($con, $query);
            $no = 1;
            if (mysqli_num_rows($userResult)) {
                while ($user = mysqli_fetch_assoc($userResult)) {
                    echo '<tr>
                        <td>' . $no . '</td>
                        <td>' . $user["user_name"] . '</td>
                        <td>' . $user["email"] . '</td>
                        <td>' . ($user["Status"] ? "Active" : "Deactive") . '</td>
                        <td><img src="img/options.png"></td>
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
<script>
    $(document).ready(function() {
        $('.mytable').DataTable({
            paging: true,
            searching: true,
            ordering: true
        });
    });
</script>
</body>

</html>