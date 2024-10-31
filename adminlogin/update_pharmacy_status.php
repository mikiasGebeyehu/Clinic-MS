<?php
include("../include/connection.php");

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $query = "UPDATE pharmacist SET status=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    if ($stmt->execute()) {
        echo "Pharmacy status updated to " . $status;
    } else {
        echo "Failed to update pharmacist status";
    }
    $stmt->close();
}
?>
