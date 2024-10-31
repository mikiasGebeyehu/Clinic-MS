<?php
session_start();
require("../include/header.php");
include("../include/connection.php");

if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    $id = $_POST['id'];

    $error = array();
    if (empty($username)) {
        $error['X'] = 'Enter username';
    } elseif (empty($password)) {
        $error['X'] = 'Enter password';
    } elseif (empty($id)) {
        $error['X'] = 'Enter Your ID';
    }

    if (count($error) == 0) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO admin(id,username,password) VALUES('$id','$username','$hashed_password')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header('Location:admin.php');
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Add Admin</title>
    <style>
        body {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);
            font-family: 'Poppins', sans-serif;
        }
        form {
            border-radius: 20px;
            margin-top: 150px !important;
            width: 35% !important;
            height: 50% !important;
            background-color: white !important;
            padding: 50px;
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
<form class="mx-auto" action="rAdmin.php" method="post">
    <h3 class="text-center">Add Admin</h3>

    <div class="mb-3 mt-5">
        <label for="exampleInputEmail1" class="form-label">User Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="uname">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">ID</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="id">
    </div>
    <div class="mb-3">
        <?php
        if (isset($error['X'])) {
            $show = $error['X'];
            echo "<div class='alert alert-danger'><h3>$show</h3></div>";
        }
        ?>
    </div>

    <button type="submit" class="btn btn-primary" name="submit">Add</button>
</form>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php
require("../include/footer.php");
?>
</body>
</html>
