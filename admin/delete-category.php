<?php
    //include constants file
    include('../config/constants.php');
    //echo "Delete Page";
    //check whether the id and image_name is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value
        //echo "get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file available
        if($image_name!="")
        {
            //image is available, so remove
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if fail to remove image add an error and stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failed To Remove Category Image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop process
                die();
            }
        }

        // delete from database 
        //sql query delete data from DB
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute query
        $res = mysqli_query($conn, $sql);

        //check whether data deleted or not
        if($res==true)
        {
            //set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //fail message
            $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        
        //redirect to manage category page

    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');

    }

?>
