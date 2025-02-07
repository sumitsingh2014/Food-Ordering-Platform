<?php
    //check whether user is logged in or not
    //Authorization- Access Control
    if(!isset($_SESSION['user']))   //if user session not set
    {
        //user is not logged in
        //redirect to login with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
        //redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }
?>