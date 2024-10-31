<?php
session_start();

require("connection.php");

if (isset($_POST['signin'])) {
    $username = trim($_POST['uname']);
    $id = trim($_POST['id']);
    $password = trim($_POST['pass']);
    $email = trim($_POST['email']);
    $phono = trim($_POST['phno']);

    $error = [];

    if (empty($username)) {
        $error['signup'] = 'Enter your username';
    } elseif (empty($id)) {
        $error['signup'] = 'Enter your ID';
    } elseif (!preg_match('/^DBU\/\d{5}\/\d{2}$/', $id)) {
        $error['signup'] = 'Invalid ID format. ID must start with DBU/ followed by 5 digits, a slash, and 2 digits.';
    } elseif (empty($password)) {
        $error['signup'] = 'Enter your password';
    } elseif (empty($email)) {
        $error['signup'] = 'Enter your email';
    } elseif (empty($phono)) {
        $error['signup'] = 'Enter your phone number';
    }

    if (count($error) == 0) {
        $status = "Pending";
        $stmt = $conn->prepare("INSERT INTO doctors (id, uname, password, email, phonenumber, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $id, $username, $password, $email, $phono, $status);

        if ($stmt->execute()) {
            echo "<script>alert('You have successfully signed up');</script>";
            header('Location: doctor.php');
            exit;
        } else {
            echo "<script>alert('Failed to sign up');</script>";
        }

        $stmt->close();
    }
}
?>
<?php
    require("include/header.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Signing up</title>
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
            background: url(include/a/assets/screen.jpeg) repeat;
            background-size: 100%;
        }
        .btn-primary {
            width: 100%;
            border: none;
            border-radius: 50px;
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, brown 100%);
        }
        .form-control {
            border: none;
            border-bottom: 1px solid;
            border-radius: 10px 0 10px 0;
            background-color: #003;
            color: #fff;
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
<form class="mx-auto" action="sign-ind.php" method="post">
    <h2 class="text-center">Sign up for Doctors</h2>

    <div class="mb-3 mt-5">
        <label for="exampleInputEmail1" class="form-label">User Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="uname">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">ID</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="id" placeholder="it must have DBU/..../.. format">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email">
    </div>
    <div class="mb-3">
        <label for="exampleInputPhone1" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="exampleInputPhone1" name="phno">
    </div>
    <div class="mb-3">
        <?php
        if (isset($error['signup'])) {
            echo "<div class='alert alert-danger'><h3>" . htmlspecialchars($error['signup']) . "</h3></div>";
        }
        ?>
    </div>

    <button type="submit" class="btn btn-primary" name="signin">Sign Up</button>
    <p>I already have an account: <a href="doctor.php">Click here!!!</a></p>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
