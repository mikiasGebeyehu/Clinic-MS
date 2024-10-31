<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Details</title>
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
        .table-container {
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #007bff;
            color: #fff;
            text-align: center;
        }
        .table td {
            text-align: left;
            vertical-align: middle;
            font-size: 16px;
        }
        .table .text-center {
            text-align: center;
            font-weight: bold;
            font-size: 20px;
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
        .medicine-profile {
            margin-bottom: 20px;
            color: #007bff;
            font-size: 28px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");

    if (isset($_GET['view_id'])) {
        $id = $_GET['view_id'];
        $sql = "SELECT * FROM pharmacy WHERE medicine_id = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 sidenav">
                        <?php include("sidenav.php"); ?>
                    </div>
                    <div class="col-md-10">
                        <div class="table-container">
                            <h5 class="medicine-profile"><?php echo htmlspecialchars($row['medicine_name']); ?> Profile</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2" class="text-center"><?php echo htmlspecialchars($row['medicine_name']); ?> Detail</th>
                                </tr>
                                <tr>
                                    <td><strong>ID</strong></td>
                                    <td><?php echo htmlspecialchars($row['medicine_id']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Medicine Full Name</strong></td>
                                    <td><?php echo htmlspecialchars($row['medicine_name']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Entrance Date</strong></td>
                                    <td><?php echo htmlspecialchars($row['date_enter']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Expiry Date</strong></td>
                                    <td><?php echo htmlspecialchars($row['expire_date']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Pharmacist</strong></td>
                                    <td><?php echo htmlspecialchars($row['pharmacist_rec']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Price (Birr)</strong></td>
                                    <td><?php echo htmlspecialchars($row['amount']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Quantity in the Store</strong></td>
                                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Description</strong></td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo "<div class='container'><p class='alert alert-danger'>Medicine not found.</p></div>";
        }
    } else {
        echo "<div class='container'><p class='alert alert-danger'>No medicine ID provided.</p></div>";
    }
    ?>
</body>
</html>
