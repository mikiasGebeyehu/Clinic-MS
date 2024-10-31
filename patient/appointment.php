<?php

require("../connection.php");

session_start();

$current_date = date('Y-m-d H:i:s'); // Get current date and time
$patient = $_SESSION['patient'];
$query = mysqli_query($conn, "SELECT * FROM patients WHERE uname='$patient'");

if (!$query) {
    die('Query execution failed: ' . mysqli_error($conn));
}

$row = mysqli_fetch_array($query);

if (!$row) {
    die('No rows found for username: ' . $patient);
}

$patientname = $row['uname'];
$patientphone = $row['phonenumber'];

if (isset($_POST['book'])) {
    $date = $_POST['date'];
    $sym = $_POST['sym'];

    if (empty($sym)) {
        $error['login'] = "Please enter your symptoms";
    } else {
        $query = "INSERT INTO appointment (username, phonenumber, appointment_date, symptoms, status, date_booked) 
                  VALUES ('$patientname', '$patientphone', '$date', '$sym', 'pending', '$current_date')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $error['login'] = "You have booked an appointment";
        } else {
            $error['login'] = "Failed to book an appointment: " . mysqli_error($conn);
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Doctor Login</title>
    <style>
        body {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);
            font-family: 'Poppins', sans-serif;
        }
        form {
            border-radius: 20px;
            margin-top: 50px !important;
            width: 35% !important;
            background-color: #000 !important;
            padding: 50px;
            color: #fff;
        }
        .btn-primary {
            width: 100%;
            border: none;
            border-radius: 50px;
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, brown 100%);
        }
        .form-control {
            border: none;
            border-bottom: 1px solid;
            border-radius: 10px 0 10px 0;
            background-color: #003;
            color: #fff;
        }
        h4 {
            font-size: 2rem !important;
            font-weight: 700;
        }
        .form-label {
            font-weight: 800 !important;
        }
    </style>
</head>
<body>
    <?php
     require("../include/header.php");
    ?>
<form class="mx-auto" action="appointment.php" method="post">
    <h3 class="text-center">Book Appointment</h3>
    
    <div class="mb-3 mt-5">
        <label for="exampleInputEmail1" class="form-label">Appointment Date</label>
        <input type="date" class="form-control" id="exampleInputEmail1" name="date">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Symptoms</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="sym" placeholder="Enter the symptoms that are seen entirely...">
    </div>
    <div class="mb-3">
        <?php
        if (isset($error['login'])) {
            echo "<div class='alert alert-danger'><h3>" . htmlspecialchars($error['login']) . "</h3></div>";
        }
        ?>
    </div>
    <button type="submit" class="btn btn-primary" name="book">Book Appointment</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<?php require("../include/footer.php"); ?>
</body>
</html>
