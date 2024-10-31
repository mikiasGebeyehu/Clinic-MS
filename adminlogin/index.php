<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
</head>
<body>
    <?php
        include("../include/header.php");
        include("../include/connection.php");
    ?>
    
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                <?php
                    include("sidenav.php");
                ?>
                </div>
                <div class="col-md-10">
                    <h4 class="my-2" style="margin-left: 10px;">Admin Dashboard</h4>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 bg-success mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php
                                                $ad = mysqli_query($conn, "SELECT * FROM admin");
                                                $num = mysqli_num_rows($ad);
                                            ?>
                                            <h5 class="my-2 text-white" style="font-size: 30px;">
                                                <?php echo $num; ?>
                                            </h5>
                                            <h5 class="my-2 text-white">Total</h5>
                                            <h5 class="my-2 text-white">Admin</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="admin.php"><i class="fa fa-users-cog fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-info mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php
                                            $doctor=mysqli_query($conn,"SELECT*FROM doctors WHERE status='approved'");

                                            $num2=mysqli_num_rows($doctor);
                                            ?>
                                            <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $num2; ?></h5>

                                            <h5 class="my-2 text-white">Total</h5>
                                            <h5 class="my-2 text-white">Doctors</h5>
                                            
                                        </div>
                                        <div class="col-md-3">
                                            <a href="approved_doctors.php"><i class="fa fa-user-md fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-warning mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php
                                                $sql="SELECT*FROM patients";
                                                $result=mysqli_query($conn,$sql);
                                                $pat=mysqli_num_rows($result);

                                            ?>
                                            <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $pat; ?></h5>

                                            <h5 class="my-2 text-white">Total</h5>
                                            <h5 class="my-2 text-white">Patients</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="patient.php"><i class="fa fa-procedures fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-danger mx-2 my-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php
                                                $stmt = $conn->prepare("SELECT * FROM doctors WHERE status = ?");
                                                $status = 'pending';
                                                $stmt->bind_param("s", $status);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                $num1 = $result->num_rows;
                                                $stmt->close();
                                            ?>
                                            <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $num1; ?></h5>
                                            <h5 class="my-2 text-white">Total</h5>
                                            <h5 class="my-2 text-white" style="font-size: smaller;">Doctor's Requests</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="Doctors-Request.php"><i class="fa fa-book-open fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-warning mx-2 my-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php
                                                $income=mysqli_query($conn,"SELECT sum(amount_paid) as profit FROM income");
                                                $row=mysqli_fetch_array($income);

                                                $inc=$row['profit'];
                                            ?>
                                            
                                            <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo 'Birr '.$inc; ?></h5>
                                            <h5 class="my-2 text-white">Total</h5>
                                            <h5 class="my-2 text-white">Income</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="income.php"><i class="fa fa-money-check-alt fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-success mx-2 my-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                        <?php
                                                $sql="SELECT*FROM reports";
                                                $result=mysqli_query($conn,$sql);
                                                $pat=mysqli_num_rows($result);

                                            ?>
                                            <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $pat; ?></h5>
                                            
                                            <h5 class="my-2 text-white">Total</h5>
                                            <h5 class="my-2 text-white">Report</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="report.php"><i class="fa fa-flag fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-danger mx-2 my-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php
                                                $stmt = $conn->prepare("SELECT * FROM pharmacist WHERE status = ?;");
                                                $status = 'Pending';
                                                $stmt->bind_param("s", $status);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                $num1 = $result->num_rows;
                                                $stmt->close();
                                            ?>
                                            <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $num1; ?></h5>
                                            <h5 class="my-2 text-white">Total</h5>
                                            <h5 class="my-2 text-white" style="font-size: smaller;">pharmacist's Requests</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="pharmacist-Request.php"><i class="fa fa-book-open fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-info mx-2 my-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php
                                                $sql="SELECT*FROM board";
                                                $result=mysqli_query($conn,$sql);
                                                $pat=mysqli_num_rows($result);

                                            ?>
                                            <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $pat; ?></h5>

                                            <h5 class="my-2 text-white">Information</h5>
                                            <h5 class="my-2 text-white">Board</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="messeging.php"><i class="fa fa-info fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="rAdmin.php"><button type="submit" class="btn btn-primary my-5" name="login">Add admin</button></a>
                                        
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</body>
</html>
