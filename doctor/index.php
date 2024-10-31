<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
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
                    <h4 class="my-2" style="margin-left: 10px;">Doctor Dashboard</h4>
                    <div class="col-md-12">
                        <div class="row">
                                                        
                            <div class="col-md-3 bg-danger mx-2" style="height: 130px;">
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
                            
                            <div class="col-md-3 bg-warning mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h5 class="my-2 text-white" style="font-size: 25px;">NO SIGNAL</h5>
                                            <h5 class="my-2 text-white">Total</h5>
                                            <h5 class="my-2 text-white">Income</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href=""><i class="fa fa-money-check-alt fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-success mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                        <?php
                                                $sql="SELECT*FROM appointment WHERE status='pending'";
                                                $result=mysqli_query($conn,$sql);
                                                $pat=mysqli_num_rows($result);

                                            ?>
                                            <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $pat; ?></h5>
                                            <h5 class="my-2 text-white">Total</h5>
                                            <h5 class="my-2 text-white">Appiontment</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="appointment.php"><i class="fa fa-calendar fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-success mx-2 mt-5" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                        <?php
                                                $sql="SELECT*FROM board";
                                                $result=mysqli_query($conn,$sql);
                                                $pat=mysqli_num_rows($result);

                                            ?>
                                            <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $pat; ?></h5>
                                            <h5 class="my-2 text-white">Total</h5>
                                            <h5 class="my-2 text-white">Updates</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="board.php"><i class="fa fa-info fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</body>
</html>