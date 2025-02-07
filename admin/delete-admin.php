<?php
    
    //include conatant.php file
    include('../config/constants.php');

    //1.get id to be delete
    $id = $_GET['id'];

    //2.create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check query executed correctly or not
    if($res==TRUE)
    {
        //echo "Admin Deleted";
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else
    {
        //failed to delete
        //echo "Failed to Delete Admin";
         $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
         header('location:'.SITEURL.'admin/manage.admin.php');

    }

    //3.redirect to manage admin page with message

?>>