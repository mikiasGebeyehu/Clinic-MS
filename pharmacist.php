<?php
session_start();
require("connection.php");

if (isset($_POST['login'])) {
    $uname = trim($_POST['name']);
    $password = trim($_POST['pass']);
    $error = [];

    if (empty($uname)) {
        $error['login'] = "Enter your username";
    } elseif (empty($password)) {
        $error['login'] = "Enter your password";
    } else {
        $stmt = $conn->prepare("SELECT * FROM pharmacist WHERE fullname = ?");
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            if (password_verify($password, $row['password'])) {
                if ($row['status'] == "pending") {
                    $error['login'] = "Wait for the Admin to confirm";
                } elseif ($row['status'] == "rejected") {
                    $error['login'] = "Sign up again your request is rejected";
                } else {
                    echo "<script>alert('You can successfully login')</script>";
                    $_SESSION['pharmacy'] = $uname;
                    header('Location: pharmacy/index.php'); // Redirect to the dashboard or appropriate page
                    exit;
                }
            } else {
                // Invalid password
                $error['login'] = "Invalid Account";
            }
        } else {
            // No user found with that username
            $error['login'] = "Invalid Account";
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
    <title>Doctor Login</title>
    <style>
        body {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);
            font-family: 'Poppins', sans-serif;
        }
        form {
            border-radius: 20px;
            margin-top: 50px !important;
            width: 35% !important;
            background-color: #000 !important;
            padding: 50px;
            color: brown;
            background: url(include/a/assets/care2.jpeg) repeat;
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
<form class="mx-auto" action="pharmacist.php" method="post">
    <h3 class="text-center">Pharmacy Login</h3>
    <div class="mb-3 mt-5">
        <label for="exampleInputEmail1" class="form-label">User Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="name">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
    </div>
    <div class="mb-3">
        <?php
        if (isset($error['login'])) {
            echo "<div class='alert alert-danger'><h3>" . htmlspecialchars($error['login']) . "</h3></div>";
        }
        ?>
    </div>
    <button type="submit" class="btn btn-primary" name="login">Login</button>
    <p>I don't have an account: <a href="sign-upp.php">Sign Up!!!</a></p>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
