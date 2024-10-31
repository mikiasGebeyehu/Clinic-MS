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
    <link rel="stylesheet" href="style.css">
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
                    <h4 class="my-2" style="margin-left: 10px;">Pharmacist Dashboard</h4>
                    <div class="col-md-12">
                        <div class="row">
                                                        
                            <div class="col-md-3 bg-danger mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h5 class="my-2 text-white" style="font-size: 30px;"></h5>
                                            <h5 class="my-2 text-white">pharmacist</h5>
                                            <h5 class="my-2 text-white">information</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="profile.php"><i class="fa fa-user-circle fa-2x my-4" style="color: #f3dbdb;"></i></a>
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
                                            <h5 class="my-2 text-white">Total university</h5>
                                            <h5 class="my-2 text-white">Income</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href=""><i class="fa fa-money-check-alt fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 bg-info mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h5 class="my-2 text-white" style="font-size: 30px;"></h5>
                                            <h5 class="my-2 text-white">Report</h5>
                                            
                                        </div>
                                        <div class="col-md-3">
                                            <a href="report.php"><i class="fa fa-flag fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-primary mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h5 class="my-2 text-white" style="font-size: 30px;"></h5>
                                            <h5 class="my-2 text-white">Add</h5>
                                            <h5 class="my-2 text-white">Medication</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="amedicine.php"><i class="fa fa-user-medicine fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-dark mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h5 class="my-2 text-white" style="font-size: 30px;"></h5>
                                            <h5 class="my-2 text-white">View</h5>
                                            <h5 class="my-2 text-white">Medication</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="vmedicine.php"><i class="fa-solid fa-droplet fa-2x my-4" style="color: #f3dbdb;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-success mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                                <?php
                                                 $sql="SELECT*FROM income";
                                                 $result=mysqli_query($conn, $sql);
                                                 $row=mysqli_num_rows($result);

                                                ?>
                                            <h5 class="my-2 text-white" style="font-size: 30px;"></h5>
                                            <h5 class="my-2 text-white"><?php echo $row ?> </h5>
                                            <h5 class="my-2 text-white">View</h5>
                                            <h5 class="my-2 text-white">prescription</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="vprescription.php"><i class="fa-solid fa-folder-open fa-2x my-4" style="color: #f3dbdb;"></i></a>
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