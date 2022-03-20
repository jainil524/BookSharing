<?php
    session_start();
    function Rlchecker($role,$er_code=404,$er_title="Page not found",$er_desc = "This page could be deleted or may be renamed"){
        if($_SESSION['role'] == $role){
            return true;
        }
        else{
            $erro_code = $er_code;
            $erro_title = $er_title;
            $erro_desc = $er_desc;

            require "php/error.php";
            exit();
        }
    }
?>