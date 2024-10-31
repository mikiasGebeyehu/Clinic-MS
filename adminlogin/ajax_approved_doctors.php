<?php
include("../include/connection.php");

$query = "SELECT id, uname, email, phonenumber FROM doctors WHERE status='approved'";
$result = mysqli_query($conn, $query);

$output = "";

// Start output buffering
ob_start();

$output .= "
<div class='container mt-4'>
    <div class='card'>
        <div class='card-header bg-dark text-white text-center'>
            <h4>Approved Doctors</h4>
        </div>
        <div class='card-body p-0'>
            <div class='table-responsive'>
                <table class='table table-hover table-bordered m-0'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>
";

if (mysqli_num_rows($result) < 1) {
    $output .= "
        <tr>
            <td colspan='4' class='text-center text-danger font-weight-bold'>NO APPROVED DOCTORS</td>
        </tr>
    ";
} else {
    while ($row = mysqli_fetch_array($result)) {
        $output .= "
        <tr>
            <td>{$row['id']}</td>
            <td>{$row['uname']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phonenumber']}</td>
        </tr>";
    }
}

$output .= "
                    </tbody>
                </table>
            </div>
        </div>
        <div class='card-footer text-center'>
            <small>Doctor's Information</small>
        </div>
    </div>
</div>
";

// End output buffering and get content
$output .= ob_get_clean();

echo $output;
?>
