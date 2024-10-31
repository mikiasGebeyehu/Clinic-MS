<?php
session_start(); // Start the session at the beginning

include("include/connection.php");

// Check if form is submitted
if (isset($_POST['login'])) {
    $username = $_POST['name'];
    $password = $_POST['pass'];

    $error = array();
    if (empty($username)) {
        $error['admin'] = 'Enter username';
    } elseif (empty($password)) {
        $error['admin'] = 'Enter password';
    }

    if (count($error) == 0) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // Verify password using password_verify
            if (password_verify($password, $user['password'])) {
                echo "<script>alert('You have logged in as an admin');</script>";
                $_SESSION['admin'] = $username;
                header("Location: adminlogin/index.php");
                exit();
            } else {
                echo "<script>alert('Invalid username or password');</script>";
            }
        } else {
            echo "<script>alert('Invalid username or password');</script>";
        }
        $stmt->close();
    }
}
$conn->close();
?>
<?php
    require("include/header.php");
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Admin Login</title>
    <style>
        body {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);
            font-family: 'Poppins', sans-serif;
        }
        form {
            border-radius: 20px;
            margin-top: 50px !important;
            width: 50% !important;
            background-color: #000 !important;
            padding: 50px;
            color: brown;
            background: url(include/a/assets/stethscope.jpg)no-repeat;
            background-size: 100%;
           
        }
        .btn-primary {
            width: 100%;
            border: none;
            border-radius: 50px;
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);
        }
        .form-control {
            color: rgba(0,0,0,.87);
            border-bottom-color: rgba(0,0,0,.42);
            box-shadow: none !important;
            border: none;
            border-bottom: 1px solid;
            border-radius: 4px 4px 0 0;
        }
        h4 {
            font-size: 2rem !important;
            font-weight: 700;
        }
        .form-label {
            font-weight: 800 !important;
        }
    </style>
</head>
<body>
<form class="mx-auto" action="admin.php" method="post">
    <h3 class="text-center">Admin Login</h3>

    <div class="mb-3 mt-5">
        <label for="exampleInputEmail1" class="form-label">User Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
    </div>
    
    <div class="mb-3">
        <?php
        if (isset($error['admin'])) {
            $show = $error['admin'];
        } else {
            $show = '';
        }
        echo "<div class='alert alert-danger'><h3>$show</h3></div>";
        ?>
    </div>

    <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>
</html>
