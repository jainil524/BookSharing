<?php
    $title="Notification - BookSharing";
    $css_file_name = "notification";
    require "php/navbar.php";
    require "php/RoleChecker.php";
    Rlchecker("user",403,"Access Denied","You don't have access to this page");
    Rlchecker("DeliveryGuy",403,"Access Denied","You don't have access to this page");
?>

<div id="container">
    <div id="notifications">
        <details>
            <summary>Warnings</summary>
            <ul>
                <li>warn 1</li>
                <li>warn 2</li>
                <li>warn 3</li>
            </ul>
        </details>

        <details>
            <summary>Reports</summary>
            <ul>
                <li>Reports 1</li>
                <li>Reports 2</li>
                <li>Reports 3</li>
            </ul>
        </details>
        
        <details>
            <summary>Book OTP</summary>
            <ul>
                <li>Book OTP 1</li>
                <li>Book OTP 2</li>
                <li>Book OTP 3</li>
            </ul>
        </details>
    </div>
</div>

<?php
    require "php/footer.php";
?>