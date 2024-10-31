<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }
        .container-fluid {
            padding: 20px;
        }
        .sidenav {
            background-color: #343a40;
            height: 100vh;
            color: #fff;
            padding-top: 20px;
        }
        .sidenav a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
        }
        .sidenav a:hover {
            background-color: #495057;
        }
        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h5 {
            color: #343a40;
            font-weight: bold;
        }
        .table {
            margin-top: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-danger {
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-danger:hover {
            background-color: #d9534f;
        }
        .btn-danger a {
            color: #fff;
            text-decoration: none;
        }
        .btn-danger a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php
        include("../include/header.php");
        include("../include/connection.php");

        if (isset($_GET['delete_id'])) {
            $query = "DELETE FROM admin WHERE id={$_GET['delete_id']}";
            mysqli_query($conn, $query);
        }
    ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidenav">
                <?php
                    include("sidenav.php");
                ?>
            </div>
            <div class="col-md-10">
                <div class="table-container">
                    <h5 class="text-center">ADMINISTRATION'S STAFF</h5>
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM admin";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                            echo "<td>{$row['id']}</td>";
                                            echo "<td>{$row['username']}</td>";
                                            echo "<td><button class='btn btn-danger'><a href='?delete_id={$row['id']}'>Remove</a></button></td>";
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