<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .container-fluid {
            margin-top: 20px;
        }
        .sidenav {
            background-color: #343a40;
            height: 100vh;
            padding-top: 20px;
        }
        .sidenav a {
            color: #fff;
            padding: 15px;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-bottom: 10px;
        }
        .sidenav a:hover {
            background-color: #495057;
        }
        .profile-container {
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .profile-container h5 {
            color: #007bff;
            font-size: 28px;
            font-weight: 600;
        }
        .profile-container img {
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #007bff;
            color: #fff;
            text-align: center;
        }
        .table td {
            vertical-align: middle;
            font-size: 16px;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");

    if (isset($_GET['view_id'])) {
        $id = $_GET['view_id'];
        $sql = "SELECT * FROM patients WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            $profile_image = !empty($row['profile']) ? "../include/a/assets" . htmlspecialchars($row['profile']) : "../include/a/assets/default.jpg";
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 sidenav">
                        <?php include("sidenav.php"); ?>
                    </div>
                    <div class="col-md-10">
                        <div class="profile-container">
                            <h5><?php echo htmlspecialchars($row['uname']); ?> Profile</h5>
                            <img style="width: 20%;" src="<?php echo $profile_image; ?>" alt="Profile Picture" class="img-fluid">
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2" class="text-center">Patient's Details</th>
                                </tr>
                                <tr>
                                    <td><strong>ID</strong></td>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Full Name</strong></td>
                                    <td><?php echo htmlspecialchars($row['uname']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Phone Number</strong></td>
                                    <td><?php echo htmlspecialchars($row['phonenumber']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Date of Registration</strong></td>
                                    <td><?php echo htmlspecialchars($row['date_reg']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Abnormality with Patient</strong></td>
                                    <td><?php echo htmlspecialchars($row['diseases']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Blood Type</strong></td>
                                    <td><?php echo htmlspecialchars($row['bloodtype']); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo "<div class='alert alert-danger text-center'>Patient not found.</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>No patient ID provided.</div>";
    }
    ?>
</body>
</html>
