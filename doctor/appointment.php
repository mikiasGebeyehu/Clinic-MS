<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments With Patients</title>
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
                <h5 class="text-center">Appointments With Patients</h5>
                <div class="table-container">
                    <?php
                        $query = "SELECT * FROM appointment WHERE status='pending'";
                        $result = mysqli_query($conn, $query);

                        $output = "
                            <table class='table table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Patient Name</th>
                                        <th>Phone</th>
                                        <th>Appointment Date</th>
                                        <th>Symptoms</th>
                                        <th>Date Booked</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        ";
                        if (mysqli_num_rows($result) < 1) {
                            $output .= "
                                <tr>
                                    <td class='text-center' colspan='7'>No Appointment yet</td>
                                </tr>
                            ";
                        } else {
                            while ($row = mysqli_fetch_array($result)) {
                                $output .= "
                                    <tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['username']}</td>
                                        <td>{$row['phonenumber']}</td>
                                        <td>{$row['appointment_date']}</td>
                                        <td>{$row['symptoms']}</td>
                                        <td>{$row['date_booked']}</td>
                                        <td><a href='discharge.php?discharge_id={$row['id']}' class='btn btn-info'>Check</a></td>
                                        
                                    </tr>
                                ";
                            }
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
