<?php
$title = "Reports - Book sharing";
$css_file_name = "user";

require "php/RoleChecker.php";
Rlchecker("admin");

require "php/LoginCheck.php";
require "php/dbconfig.php";
require "php/navbar.php";
?>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

<div id="main">
    <h3 class="titleofpage"> Reports</h3>
    <table class="mytable">
        <thead>
            <tr>
                <th>No</th>
                <th>Reason</th>
                <th>From</th>
                <th>To</th>
                <th>Report On</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $SelectReportsquery = "SELECT *,(SELECT user_name FROM user WHERE user_id = reporter_user) As repoerter,(SELECT user_name FROM user WHERE user_id = reported_user) As repoertedUser FROM reports ORDER BY report_time DESC";
            $SelectReportsFire = mysqli_query($con, $SelectReportsquery);
            $no = 1;
            if (mysqli_num_rows($SelectReportsFire) != 0) {
                while ($user = mysqli_fetch_assoc($SelectReportsFire)) {
                    echo '<tr>
                            <td>' . $no . '</td>
                            <td>' . $user["Report_msg"] . '</td>
                            <td>' . $user["repoerter"] . '</td>
                            <td>' .$user['repoertedUser'].'</td>
                            <td style="width:290px;">'.$user['report_time'].'</td>
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