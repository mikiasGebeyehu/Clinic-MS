<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="list-group" style="height: 100vh; background-color:aqua ">
                        <?php
                            if(isset($_SESSION['patient'])){
                                echo'<a href="../patient/index.php" class="list-group-item list-group-item-action text-center text-black"  style="background-color:aqua">Dashboard</a>';
                            }else if(isset($_SESSION['doctor'])){
                                echo'<a href="../doctor/index.php" class="list-group-item list-group-item-action text-center text-black"  style="background-color:aqua">Dashboard</a>';
                            }else{
                                echo'<a href="index.php" class="list-group-item list-group-item-action text-center text-black"  style="background-color:aqua">Dashboard</a>'; 
                            }
                        ?>
                        
                        <a href="board.php" class="list-group-item list-group-item-action bg-info text-center text-white">adminstrators</a>
                        <a href="profile.php" class="list-group-item list-group-item-action text-center text-black"  style="background-color:aqua">Pharmacist</a>
                        <a href="vmedicine.php" class="list-group-item list-group-item-action bg-info text-center text-white">Medicine</a>
                        
                    </div>
</body>
</html>