<?php
session_start();

require("../include/connection.php");

$username = $_SESSION['patient'];

// Handle the form submission
if (isset($_POST['submit'])) {
    $img = $_FILES['img']['name'];
    $target_dir = "../include/a/assets";

    // Check if the img directory exists, if not create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (!empty($img)) {
        $target_file = $target_dir . basename($img);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES['img']['tmp_name']);
        if ($check !== false) {
            // Allow certain file formats
            if (in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
                // Check if file already exists
                if (!file_exists($target_file)) {
                    // Check file size (5MB max)
                    if ($_FILES['img']['size'] <= 5000000) {
                        if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                            // Update the database
                            $query = "UPDATE patients SET profile='$img' WHERE uname='$username'";
                            if (mysqli_query($conn, $query)) {
                                $uploadSuccess = "Profile picture updated successfully.";
                            } else {
                                $uploadError = "Failed to update profile picture in database.";
                            }
                        } else {
                            $uploadError = "Sorry, there was an error uploading your file.";
                        }
                    } else {
                        $uploadError = "Sorry, your file is too large.";
                    }
                } else {
                    $uploadError = "Sorry, file already exists.";
                }
            } else {
                $uploadError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        } else {
            $uploadError = "File is not an image.";
        }
    } else {
        $uploadError = "No file selected.";
    }
}

// Retrieve user data from the database
$query = "SELECT * FROM patients WHERE uname='$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
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
    <?php include("../include/header.php"); ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        <h5>My Profile</h5>
                        <?php
                        if (isset($uploadError)) {
                            echo "<div class='alert alert-danger'>$uploadError</div>";
                        } elseif (isset($uploadSuccess)) {
                            echo "<div class='alert alert-success'>$uploadSuccess</div>";
                        }
                        ?>
                        <form action="profile.php" method="post" enctype="multipart/form-data">
                            <?php
                            if (!empty($row['profile'])) {
                                echo "<img src='img/" . htmlspecialchars($row['profile']) . "' alt='Profile Picture' class='col-md-12' style='height:250px;'>";
                            } else {
                                echo "<img src='img/default.jpg' alt='Default Profile Picture' class='col-md-12' style='height:250px;'>";
                            }
                            ?>
                            <input type="file" name="img" id="img" class="form-control my-2">
                            <button type="submit" class="btn btn-info" name="submit">Update Profile</button>
                        </form>

                        <table class="table table-bordered">
                            <tr>
                                <th colspan="2" class="text-center">My Detail</th>
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

    <?php require("../include/footer.php"); ?>
</body>
</html>
