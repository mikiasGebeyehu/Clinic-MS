<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>
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
        <div class="row">
            <div class="col-md-2" style="margin-left:-50px">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <h2 class="text-center my-2">Total income</h2>
                <div class="col-md-10">
                    <?php
                        $query="SELECT*FROM income";
                        $result=mysqli_query($conn,$query);
                        $output='';
                        $output .="
                            <table class='table table-bordered'>
                                    <tr>
                                    <td>ID</td>
                                    <td>Doctor</td>
                                    <td>Patient</td>
                                    <td>date_dischage</td>
                                    <td>Fee</td>
                                </tr>
                        ";
                        if(mysqli_num_rows($result)<1){
                            $output.="
                                <tr>
                                    <td class='text-center' colspan='6'>No Patient discharge yet</td>
                                </tr>
                            ";
                        }
                        while($row=mysqli_fetch_array($result)){
                            $output.="
                                <tr>
                                    <td>{$row["id"]}</td>
                                    <td>{$row["doctor"]}</td>
                                    <td>{$row["patient"]}</td>
                                    <td>{$row["date_discharge"]}</td>
                                    <td>{$row["amount_paid"]}</td>
                                
                            ";
                        }
                        $output.="
                            </tr>
                            </table>
                        ";

                        echo $output;
                        
                    ?>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>

<tr></tr>