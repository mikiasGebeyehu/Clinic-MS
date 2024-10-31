<?php
session_start();

require("../include/connection.php");

$username = $_SESSION['pharmacy'];

// Retrieve user data from the database
$query = "SELECT * FROM pharmacist WHERE fullname='$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .container-fluid {
            padding: 20px;
        }
        .table {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table td {
            background-color: #f8f9fa;
        }
        h5 {
            font-size: 24px;
            font-weight: 600;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .sidenav {
            background-color: #007bff;
            padding: 20px;
            height: 100vh;
        }
        .sidenav a {
            color: white;
            font-size: 18px;
            text-decoration: none;
            display: block;
            margin: 10px 0;
            transition: color 0.3s;
        }
        .sidenav a:hover {
            color: #d1e7dd;
        }
        .profile-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <?php include("../include/header.php"); ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidenav">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="profile-card">
                            <h5>My Profile</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2" class="text-center">My Detail</th>
                                </tr>
                                <tr>
                                    <td>Pharmacist ID</td>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                </tr>
                                <tr>
                                    <td>Full Name</td>
                                    <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td><?php echo htmlspecialchars($row['phonenumber']); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>