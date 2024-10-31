<?php
     include("../include/connection.php");
    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        $sql = "DELETE FROM `income` WHERE `id` = $id;";
        $result = mysqli_query($conn, $sql);

        header('Location:approved_appointment.php');
        exit;
    }
?>