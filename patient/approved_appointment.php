<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags and CSS links -->
    <title>Doctor's Response</title>
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
            text-align: center;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .text-center {
            margin-top: 20px;
            font-size: 24px;
            font-weight: 600;
            color: #343a40;
        }
        .btn-info {
            background-color: #17a2b8;
            border: none;
            width: 100px;
        }
        .btn-info:hover {
            background-color: #138496;
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
                <h1 class="text-center">The Doctor's Response</h1>
                <div class="table-container">
                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM patients WHERE uname='{$_SESSION['patient']}'");
                        $row = mysqli_fetch_array($result);

                        $patientname = $row['uname'];

                        $query = "SELECT id, doctor, patient, date_discharge, amount_paid, description, date_check, advice FROM income WHERE patient='$patientname'";
                        $result = mysqli_query($conn, $query);

                        $output = "
                            <table class='table table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Doctor</th>
                                        <th>Advice (First Aid)</th>
                                        <th>Date Discharge</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        ";

                        if (mysqli_num_rows($result) < 1) {
                            $output .= "
                                <tr>
                                    <td class='text-center' colspan='5'>No Invoice yet</td>
                                </tr>
                            ";
                        }

                        while ($row = mysqli_fetch_array($result)) {
                            $output .= "
                                <tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['doctor']}</td>
                                    <td>{$row['advice']}</td>
                                    <td>{$row['date_discharge']}</td>
                                    <td>
                                        <a href='report.php?check_id={$row['id']}' class='btn btn-info'>Report</a>
                                        <a href='delete.php?delete_id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\");'>DELETE</a>
                                    </td>
                                </tr>
                            ";
                        }

                        $output .= "
                                </tbody>
                            </table>
                        ";

                        echo $output;
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
