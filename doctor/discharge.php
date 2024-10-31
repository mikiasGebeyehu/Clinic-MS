<?php
session_start();
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
    <style>
        form {
            border-radius: 20px;
            margin-top: 50px !important;
            width: 500px !important;
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
    <?php
    include("../include/header.php");
    include("../include/connection.php");

    if (isset($_GET['discharge_id'])) {
        $id = $_GET['discharge_id'];
        $sql = "SELECT * FROM appointment WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            $profile_image = !empty($row['profile']) ? "../img/" . htmlspecialchars($row['profile']) : "../img/default.jpg";
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2" style="margin-left: -30px;">
                        <?php include("sidenav.php"); ?>
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                
                                <table class="table table-bordered"  style="margin-left: 50px;">
                                    <tr>
                                        <th colspan="1" class="text-center" style="margin-left: -30px;">Appointment's Detail</th>
                                    </tr>
                                    <tr>
                                        <td>ID</td>
                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Full Name</td>
                                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>E-mail</td>
                                        <!-- <td><?php echo htmlspecialchars($row['email']); ?></td> -->
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td><?php echo htmlspecialchars($row['phonenumber']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Appointment Date</td>
                                        <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Symptoms</td>
                                        <td><?php echo htmlspecialchars($row['symptoms']); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h2 class="text-center  my-1">Invoices and Advice</h2>
                                
                                <?php
                                
                                    if(isset($_POST['send'])){
                                        $fee = $_POST['fee'];
                                        $description = $_POST['description'];
                                        $advice = $_POST['advice'];
                                        $medpre = $_POST['medpre'];
                                        $mess = $_POST['mess'];
                                        
                                        if(empty($fee)){
                                            $error['send'] = "Please enter total fee incurred by the patient";
                                        } elseif(empty($description)){
                                            $error['send'] = "Please enter the reason for this invoice";  
                                        } else {
                                            $patientname = $row['username'];
                                            $current_date = date('Y-m-d H:i:s'); // Get current date and time
                                            $query = "INSERT INTO income (doctor, patient, date_discharge, amount_paid, description, advice, med_pre, message) VALUES ('{$_SESSION['doctor']}', '$patientname', '$current_date', $fee, '$description', '$advice', '$medpre', '$mess')";
                                    
                                            if (mysqli_query($conn, $query)) {
                                                $error['send'] = "You have sent the patient's invoice and advice";

                                                mysqli_query($conn, "UPDATE appointment SET status='discharged' WHERE id=$id");
                                                
                                            } else {
                                                $error['send'] = "You haven't sent the invoice";
                                            }
                                    
                                        }
                                    }
                                ?>
                                
                                <form method="post">
                            
                                    <label for=""  class="form-label">Fee</label>
                                    <input type="number" name="fee" placeholder="Enter Patient's Fee for the next appointment"  class="form-control">

                                    <label for=""  class="form-label">Reason for the fee</label>
                                    <input type="text" name='description' placeholder="Enter Description"  class="form-control">

                                    <label for=""  class="form-label">Advice</label>
                                    <input type="text" name='advice' placeholder="You can advise the patient about his abnormality"  class="form-control">
                                    
                                    <label for=""  class="form-label">Prescribe a Medicine</label>
                                    <input type="text" name="medpre" placeholder="Enter the medicine you prescribed"  class="form-control">
                                    
                                    <label for=""  class="form-label">Message to the Pharmacist</label>
                                    <input type="text" name="mess" placeholder="You can send a message to a pharmacist if needed"  class="form-control">
                                    
                                    <?php
                                        if (isset($error['send'])) {
                                            echo "<div class='alert alert-success'><h3>" . htmlspecialchars($error['send']) . "</h3></div>";
                                        }
                                    ?>

                                    <button type="submit" name="send" class="btn btn-primary my-2">Send Your Tempeory Advice</button>
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
