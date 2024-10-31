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
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
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
            $profile_image = !empty($row['profile']) ? "../img/" . htmlspecialchars($row['profile']) : "../img/default.jpg";
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2" style="margin-left: -30px;">
                        <?php include("sidenav.php"); ?>
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <h5><?php echo htmlspecialchars($row['uname']); ?> Profile</h5>
                                <img src="<?php echo $profile_image; ?>" alt="Profile Picture" class="col-md-12" style="height:250px;">
                                <table class="table table-bordered">
                                    <tr>
                                        <th colspan="2" class="text-center">patients's Detail</th>
                                    </tr>
                                    <tr>
                                        <td>ID</td>
                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Full Name</td>
                                        <td><?php echo htmlspecialchars($row['uname']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td><?php echo htmlspecialchars($row['phonenumber']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date of Registration</td>
                                        <td><?php echo htmlspecialchars($row['date_reg']); ?></td>
                                    </tr>
                                    <tr>
                                <td>Abnormality with patient</td>
                                <td><?php echo htmlspecialchars($row['diseases']); ?></td>
                            </tr>
                            <tr>
                                <td>Blood type</td>
                                <td><?php echo htmlspecialchars($row['bloodtype']); ?></td>
                            </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo "<p>Patient not found.</p>";
        }
    } else {
        echo "<p>No patient ID provided.</p>";
    }
    ?>
</body>
</html>
