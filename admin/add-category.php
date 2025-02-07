<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>


        <!--Add category form starts-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>



        </form>
        <!--Add category form ends-->

        <?php

            //check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1.get the value from the Category
                $title = $_POST['title'];

                //for radio input, we need to check whether the button is selected
                if(isset($_POST['featured']))
                {
                    //get the value from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //set the default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //check whether the image is selected or not and set the value for image name accordingly
                //print_r($_FILES['image']);

                //die();//break code
                if(isset($_FILES['image']['name']))
                {
                    //upload image
                    //to upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    if($image_name!="")
                    {

                        //Auto rename our image
                        //get the extension of our image(jpg,png etc) eg:food1.jpg
                        $ext = end(explode('.', $image_name));

                        //rename the image
                        $image_name = "Food_category_".rand(000,999).'.'.$ext;


                        $source_path = $_FILES['image']['tmp_name'];
                        
                        $destination_path = "../images/category/".$image_name;

                        //finally upload image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check whether the image is uploaded or not
                        //And if the image is not uploaded we will stop process and redirect
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            //redirect
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else
                {
                    //do not upload image and set value as blank
                    $image_name="";
                }

                //2.sql query to insert data

                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //3,execute the query and save in database
                $res = mysqli_query($conn, $sql);

                //4.check query executed or not
                if($res==true)
                {
                    //query executed
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //failed to add category
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    //redirect to add category page
                    header('location:'.SITEURL.'admin/add-category.php');
                    
                }

            }


        ?>

    </div>

</div>


<?php include('partials/footer.php'); ?>