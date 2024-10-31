<?php
session_start();
include("../include/connection.php"); // Include the database connection at the top
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
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $entdate = $_POST['entdate'];
    $expdate = $_POST['expdate'];
    $pharm = $_POST['pharm'];
    $fee = $_POST['fee'];
    $quan = $_POST['quan'];
    $des = $_POST['des'];

    $error = array();

    if (count($error) == 0) {
        $id = $_GET['view_id'];
        $sql = "UPDATE pharmacy SET medicine_name='$name', date_enter='$entdate', expire_date='$expdate', pharmacist_rec='$pharm', amount='$fee', quantity='$quan', description='$des' WHERE medicine_id='$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $error['X'] = 'You can update medicine successfully';
        } else {
            $error['X'] = "You can't update medicine successfully";
        }
    }
}
?>

<?php
include("../include/header.php");

if (isset($_GET['view_id'])) {
    $id = $_GET['view_id'];
    $sql = "SELECT * FROM pharmacy WHERE medicine_id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <h5><?php echo htmlspecialchars($row['medicine_name']); ?> Profile</h5>
                            <form action="edit.php?view_id=<?php echo $id; ?>" method="post">
                                <table class="table table-bordered">
                                    <tr>
                                        <th colspan="2" class="text-center">Edit <?php echo htmlspecialchars($row['medicine_name']); ?> Detail</th>
                                    </tr>
                                    <tr>
                                        <td>Medicine Full Name</td>
                                        <td><input type="text" class="form-control" id="exampleInputPassword1" name="name" value="<?php echo htmlspecialchars($row['medicine_name']); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Entrance Date</td>
                                        <td><input type="date" class="form-control" id="exampleInputPassword1" name="entdate" value="<?php echo htmlspecialchars($row['date_enter']); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Expiry Date</td>
                                        <td><input type="date" class="form-control" id="exampleInputPassword1" name="expdate" value="<?php echo htmlspecialchars($row['expire_date']); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Pharmacist</td>
                                        <td><input type="text" class="form-control" id="exampleInputPassword1" name="pharm" value="<?php echo htmlspecialchars($row['pharmacist_rec']); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Price (Birr)</td>
                                        <td><input type="text" class="form-control" id="exampleInputPassword1" name="fee" value="<?php echo htmlspecialchars($row['amount']); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Quantity in the Store</td>
                                        <td><input type="number" class="form-control" id="exampleInputPassword1" name="quan" value="<?php echo htmlspecialchars($row['quantity']); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Description about <?php echo htmlspecialchars($row['medicine_name']); ?></td>
                                        <td><input type="text" class="form-control" id="exampleInputPassword1" name="des" value="<?php echo htmlspecialchars($row['description']); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="mb-3">
                                                <?php
                                                if (isset($error['X'])) {
                                                    $show = $error['X'];
                                                    echo "<div class='alert alert-success'><h3>$show</h3></div>";
                                                }
                                                ?>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="submit">Done</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
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
