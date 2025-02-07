<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .login h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .login input[type="text"],
        .login input[type="password"] {
            width: 100%;
            padding: 5px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn-primary {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #4cae4c;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login">
        <h1>Login</h1>
        <br>

        <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        <br>

        <!-- Login form start -->
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Enter Username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="submit" name="submit" value="Login" class="btn-primary">
        </form>
        <!-- Login ends -->

        <p>Created By - Sumit Kumar Singh</p>
    </div>
</body>
</html>

<?php
// Check whether submit button is clicked or not
if (isset($_POST['submit'])) {
    // Process for login
    // 1. Get data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // SQL query to check whether the user with name and password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // 3. Execute the query
    $res = mysqli_query($conn, $sql);

    // 4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // User available
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; // To check whether user is logged in or not

        // Redirect to Home page or dashboard
        header('location:' . SITEURL . 'admin/');
    } else {
        // User not available
        $_SESSION['login'] = "<div class='error text-center'>Login Failed.</div>";
        // Redirect to Home page or dashboard
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>
