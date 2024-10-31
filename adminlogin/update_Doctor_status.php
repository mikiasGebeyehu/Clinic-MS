<?php
include("../include/connection.php");

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $query = "UPDATE doctors SET status=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    if ($stmt->execute()) {
        echo "Doctor status updated to " . $status;
    } else {
        echo "Failed to update doctor status";
    }
    $stmt->close();
}
?>
