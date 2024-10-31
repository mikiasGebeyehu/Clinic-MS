<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Invoice Details</title>
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
            vertical-align: middle;
            font-size: 16px;
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
        .invoice-title {
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

    if (isset($_GET['check_id'])) {
        $id = $_GET['check_id'];
        $sql = "SELECT * FROM income WHERE id = '$id'";
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
                            <h5 class="invoice-title">Invoice Details for <?php echo htmlspecialchars($row['patient']); ?></h5>

                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2" class="text-center">Invoice Information</th>
                                </tr>
                                <tr>
                                    <td><strong>ID</strong></td>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Doctor Name</strong></td>
                                    <td><?php echo htmlspecialchars($row['doctor']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Patient Name</strong></td>
                                    <td><?php echo htmlspecialchars($row['patient']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Discharging Date</strong></td>
                                    <td><?php echo htmlspecialchars($row['date_discharge']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Amount Paid</strong></td>
                                    <td><?php echo htmlspecialchars($row['amount_paid']); ?></td>
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
            echo "<div class='container'><p class='alert alert-danger'>Invoice not found.</p></div>";
        }
    } else {
        echo "<div class='container'><p class='alert alert-danger'>No invoice ID provided.</p></div>";
    }
    ?>
</body>
</html>
