<?php include('partials/menu.php');?>
<?php include('../config/constants.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))// checking whether the sessionis set or not
            {
                echo $_SESSION['add'];//Display session message if set
                unset($_SESSION['add']);//removing session message
            }
        
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>


<?php include('partials/footer.php');?>


<?php
    //Process the value from form and save it in database

    //Check whether the button is clicked or not

    if(isset($_POST['submit']))
    {
        //button clicked
        //echo "Button Clicked";

        //get the data from form
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];
         $password = md5($_POST['password']);//password encryption

         //SQL query to save the data into database
         $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password= '$password'
        ";
        



        //executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. check whether data is inserted or not
        if($res==TRUE)
        {
            //data inserted
            //Create a session variable to display Message
            $_SESSION['add'] = "Admin Added Successfully";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //failed to insert data
            $_SESSION['add'] = "Failed to Add Admin";
            //Redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');

        }
    }
?>