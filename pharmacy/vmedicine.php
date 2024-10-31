<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicines in Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .table-container {
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .table {
            margin-bottom: 0;
        }
        .table thead th {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table tbody td {
            text-align: center;
            vertical-align: middle;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn-info, .btn-danger {
            width: 75px;
            margin: 2px;
        }
        .text-center {
            margin-top: 20px;
            font-size: 24px;
            font-weight: 600;
            color: #343a40;
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
    </style>
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidenav">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <div class="table-container">
                    <h5 class="text-center">Medicines in Store</h5>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Medicine ID</th>
                                <th>Medicine's Name</th>
                                <th>Entrance Date</th>
                                <th>Expiry Date</th>
                                <th>Amount (in Birr)</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT * FROM pharmacy";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$row['medicine_id']}</td>";
                                echo "<td>{$row['medicine_name']}</td>";
                                echo "<td>{$row['date_enter']}</td>";
                                echo "<td>{$row['expire_date']}</td>";
                                echo "<td>{$row['amount']}</td>";
                                echo "<td>{$row['quantity']}</td>";
                                echo "<td>{$row['description']}</td>";
                                if(isset($_SESSION['pharmacy'])){
                                    echo "<td>
                                        <a href='view.php?view_id={$row['medicine_id']}' class='btn btn-info'>View</a>
                                        <a href='edit.php?view_id={$row['medicine_id']}' class='btn btn-danger'>Edit</a>
                                    </td>";
                                }
                                echo "</tr>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
