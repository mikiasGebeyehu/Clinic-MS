<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>
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
        .btn-info, .btn-success {
            width: 100px;
            margin: 2px;
        }
        .btn-info:hover {
            background-color: #138496;
        }
        .btn-success:hover {
            background-color: #218838;
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
                    <h5 class="text-center">Patients</h5>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Patient's Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT * FROM patients";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$row['id']}</td>";
                                echo "<td>{$row['uname']}</td>";
                                echo "<td>{$row['email']}</td>";
                                echo "<td>{$row['phonenumber']}</td>";
                                echo "<td>
                                    <a href='view.php?view_id={$row['id']}' class='btn btn-info'>View</a>
                                    <a href='messeging.php?view_name={$row['uname']}' class='btn btn-success'>Message</a>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No patients found</td></tr>";
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
