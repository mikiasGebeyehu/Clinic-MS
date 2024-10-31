<?php

require("../connection.php");

session_start();

if (isset($_POST['send'])) {
    $title = trim($_POST['title']);
    $message = trim($_POST['mess']);
    $error = [];

    if (empty($title)) {
        $error['send'] = "Enter title to the report";
    } elseif (empty($message)) {
        $error['send'] = "Enter a message of report";
    }

    if (count($error) == 0) {
        $current_date = date('Y-m-d H:i:s'); // Get current date and time
        $stmt = $conn->prepare("INSERT INTO reports (title, message, username, date_send) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $message, $_SESSION['patient'], $current_date);

        if ($stmt->execute()) {
            $error['send'] = "You have sent your report";
        } else {
            $error['send'] = "You haven't sent your report";
        }

        $stmt->close();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Patients Login</title>
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
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,0,1) 100%);
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
<form class="mx-auto" action="report.php" method="post">
    <h3 class="text-center">Send Any Report</h3>
    <div class="mb-3 mt-5">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title of the report">
    </div>

    <div class="mb-3">
        <label for="message" class="form-label">Report Message</label>
        <input type="text" class="form-control" id="message" name="mess" placeholder="Enter your messages...">
    </div>

    <div class="mb-3">
        <?php
        if (isset($error['send'])) {
            echo "<div class='alert alert-success'><h3>" . htmlspecialchars($error['send']) . "</h3></div>";
        }
        ?>
    </div>
    
    <button type="submit" class="btn btn-primary" name="send">Send Message</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<?php require("../include/footer.php"); ?>
</body>
</html>
