<?php
ob_start();  // Start output buffering
session_start();
require("../include/header.php");
require("../connection.php");

// Ensure the user is logged in
if (!isset($_SESSION['patient'])) {
    die("Unauthorized access.");
}

$errors = [];
$messages = [];

if (isset($_GET['view_name'])) {
    $receiver = $conn->real_escape_string($_GET['view_name']); // Escape the receiver (doctor's name)
    $username = $conn->real_escape_string($_SESSION['patient']); // Escape the logged-in patient name

    // Fetch all previous messages where the patient is either the sender or the receiver
    $sql = "SELECT message, username, date_send FROM message WHERE 
            (receiver = '$receiver' AND username = '$username') OR 
            (receiver = '$username' AND username = '$receiver') 
            ORDER BY date_send ASC";
    
    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    } else {
        die('Query failed: ' . htmlspecialchars($conn->error));
    }

    if (isset($_POST['send'])) {
        $message = trim($_POST['mess']);

        if (empty($message)) {
            $errors['send'] = "Enter your message before sending it.";
        }

        if (empty($errors)) {
            $message = $conn->real_escape_string($message);
            $current_date = date('Y-m-d H:i:s'); // Get current date and time
            $sql = "INSERT INTO message (receiver, message, username, date_send) 
                    VALUES ('$receiver', '$message', '{$_SESSION['patient']}', '$current_date')";

            if ($conn->query($sql)) {
                echo "<div class='alert alert-success'><h3>" . htmlspecialchars($message) . "</h3></div>";
                // Redirect to refresh the page and prevent form resubmission
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            } else {
                $errors['send'] = "There was an error sending your message: " . htmlspecialchars($conn->error);
            }
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
    <title>Messages with Doctor</title>
    <style>
        body {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);
            font-family: 'Poppins', sans-serif;
        }
        form {
            border-radius: 20px;
            margin-top: 20px !important;
            width: 75% !important;
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
        .message-box {
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            color: #000;
        }
        .message-patient {
            background-color: #d1e7dd; /* Light green background for patient's messages */
        }
        .message-doctor {
            background-color: #f8d7da; /* Light red background for doctor's messages */
        }
        .message-meta {
            font-size: 0.8rem;
            color: #555;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Messages with Doctor: <?php echo htmlspecialchars($receiver); ?></h2>
    <div>
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $msg): ?>
                <div class="message-box <?php echo ($msg['username'] === $_SESSION['patient']) ? 'message-patient' : 'message-doctor'; ?>">
                    <p><?php echo htmlspecialchars($msg['message']); ?></p>
                    <div class="message-meta">
                        <span>From: <?php echo htmlspecialchars($msg['username']); ?></span><br>
                        <span>Sent: <?php echo htmlspecialchars($msg['date_send']); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No messages found.</p>
        <?php endif; ?>
    </div>

    <form class="mx-auto" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?view_name=' . urlencode($receiver); ?>" method="post">
        <div class="mb-3">
            <input type="text" class="form-control" id="message" name="mess" placeholder="Enter your message...">
        </div>

        <?php if (isset($errors['send'])): ?>
            <div class="alert alert-danger"><?php echo $errors['send']; ?></div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary" name="send">Send Message</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php ob_end_flush();  // End output buffering ?>