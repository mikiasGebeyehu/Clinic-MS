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

// Check if the file_path column exists, and add it if not
$result = $conn->query("SHOW COLUMNS FROM board LIKE 'file_path'");
if ($result->num_rows == 0) {
    $alter_sql = "ALTER TABLE board ADD COLUMN file_path VARCHAR(255) DEFAULT NULL";
    if (!$conn->query($alter_sql)) {
        die("Failed to alter table: " . htmlspecialchars($conn->error));
    }
}

// Fetch all messages from the board database
$sql = "SELECT id, message, name, date_send, file_path FROM board ORDER BY date_send DESC"; // Display latest messages first
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
} else {
    die('Query failed: ' . htmlspecialchars($conn->error));
}

// Handle new message submission
if (isset($_POST['send'])) {
    $message = trim($_POST['mess']);
    $file_path = null;

    if (empty($message)) {
        $errors['send'] = "Enter your message before sending it.";
    }

    // Handle file upload
    if (!empty($_FILES['file']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['file']['name']);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow certain file formats
        $allowed_types = ['jpg', 'png', 'pdf', 'docx'];
        if (!in_array($file_type, $allowed_types)) {
            $errors['file'] = "Only JPG, PNG, PDF, and DOCX files are allowed.";
        }

        // Check if file was uploaded without errors
        if (empty($errors) && move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            $file_path = $conn->real_escape_string($target_file);
        } else {
            $errors['file'] = "There was an error uploading your file.";
        }
    }

    if (empty($errors)) {
        $message = $conn->real_escape_string($message);
        $current_date = date('Y-m-d H:i:s'); // Get current date and time
        $sql = "INSERT INTO board (message, name, date_send, file_path) 
                VALUES ('$message', '{$_SESSION['admin']}', '$current_date', '$file_path')";

        if ($conn->query($sql)) {
            // Redirect to refresh the page and prevent form resubmission
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            $errors['send'] = "There was an error sending your message: " . htmlspecialchars($conn->error);
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
    <title>Admin Board</title>
    <style>
        body {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);
            font-family: 'Poppins', sans-serif;
        }
        .container {
            margin-top: 20px;
            max-width: 700px;
        }
        form {
            border-radius: 20px;
            margin-top: 20px !important;
            background-color: #000 !important;
            padding: 30px;
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
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }
        .message-meta {
            font-size: 0.8rem;
            color: #555;
        }
        .message-content {
            font-family: 'Times New Roman', serif;
            font-size: 1.1rem;
            line-height: 1.5;
            color: #333;
        }
        .message-sender {
            font-weight: bold;
        }
        .message-date {
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Admin Board</h2>
    <div>
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $msg): ?>
                <div class="message-box">
                    <div class="message-content">
                        <p><?php echo nl2br(htmlspecialchars($msg['message'])); ?></p>
                        <?php if ($msg['file_path']): ?>
                            <p>Attached file: <a href="<?php echo htmlspecialchars($msg['file_path']); ?>" target="_blank">View/Download</a></p>
                        <?php endif; ?>
                    </div>
                    <div class="message-meta">
                        <span class="message-sender">Sincerely, <?php echo htmlspecialchars($msg['name']); ?></span><br>
                        <span class="message-date">Posted on: <?php echo htmlspecialchars($msg['date_send']); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No updates found.</p>
        <?php endif; ?>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php ob_end_flush();  // End output buffering ?>
