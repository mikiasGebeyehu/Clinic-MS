
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
        <style>
        *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    
}

.link-btn {
    display: inline-block;
    padding: 1rem 3rem;
    border-radius: .5rem;
    background-color: var(--darkblue);
    cursor: pointer;
    font-size: 1.7rem;
    color: var(--white);
    transition: background 0.4s;
}

.link-btn:hover {
    background-color: var(--light-color);
    color: var(--white);
}

.header {
    display: flex;
    padding: 2rem;
    border-bottom: var(--border);
    background-color: var(--nav);
    justify-content: space-between;
    background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);
    
}

.header.active {
    background-color: var(--nav);
    box-shadow: var(--box-shadow);
    border: 0;
}

.header .logo {
    font-size: 3rem;
    color: var(--black);
}

.header .logo span {
    color: var(--darkblue);
}

.header .nav a {
    margin: 0 1rem;
    font-size: 5rem;
    color: var(--black);
    font-weight: 400;
    position: relative;
}

.header .nav a:hover {
    color: var(--white);
}

.header .nav a::after {
    content: '';
    width: 0;
    height: 3px;
    background: var(--darkblue);
    position: absolute;
    left: 0;
    bottom: -4px;
    transition: 0.5s;
}

.header .nav a:hover::after {
    width: 100%;
}

body{
    background: #f3dbdb;
}
.navbar{
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #0a4592;
    padding: 10px 20px;
    color: #fff;
    height: 75px;
}
a{
    text-decoration: none;
    color: inherit;

}
ul{
   
    display: flex;
    gap: 10px;
    list-style-type: none;
}
ul a{
    text-decoration: none;
    color: inherit;
}
nav h1{
    font-family: 'Times New Roman', Times, serif;
    font-weight: 400;
    color: #050029;
    
}
.nav_bottom1{
    margin-top: 10px;
    margin-left: 12.5%;
    border-radius: 20px;
    width: 75%;
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 8px 20px;
    background: #000;
    color: #fff;
    font-size: 15px;
    margin-bottom: 70px;
}
.nav_bottom1 div{
    display: flex;
    gap: 5px;
    align-items: center;
    font-weight: 500px;
}
.nav_bottom1 button{
    background: linear-gradient(90deg, rgba(30,50,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);
    color: #fff;
    border-radius: 10px;
    
    padding: 5px;
}
.nav_bottom1 button a{
    text-decoration: none;
    color: inherit;
}
.nav2{
    text-align: center;
    margin-left: 300px;
    font-size:x-large;
}
.nav_bottom2{
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 8px 20px;
    background: url(include/a/assets/wp3774946.webp)repeat;
    color: #000;
    font-size: 15px;
    margin-bottom: -10px;
   
}
.nav_bottom2 p{
    font-family: Georgia, 'Times New Roman', Times, serif;
    gap: 5px;
    align-items: center;
    font-weight: bold;
}
.nav_bottom2 div{
    margin-left: 59%;
    display: flex;
    gap: 5px;
    align-items: center;
    font-weight: 500px;
}
.nav_bottom2 button{
    background-color: #050029;
    color: #fff;
    border-radius: 10px;
    
    padding: 5px;
}
.nav_bottom2 button a{
    text-decoration: none;
    color: inherit;
}
    </style>
</head>
<body>
<?php

if(!isset($_SESSION["patient"])&&!isset($_SESSION["doctor"])&&!isset($_SESSION["admin"])&&!isset($_SESSION["pharmacy"])){

echo' <div class="nav_bottom2">
        <p style="font-size:10px"><a href="https://dbu.edu.et/"><img src="include/a/assets/logo4.png" width="200px" class="header_img" alt="" style="border-radius: 10px;"></p>
        <div>
            <p style="font-size: larger; margin-top:9px ">Social media:</p>
            <a href="https://www.facebook.com/dbu.edu.et"><img src="include/a/assets/icons8-facebook-48.png" width="30px" class="header_img" alt=""></a>
            <a href="https://t.me/debreberhan_university"><img src="include/a/assets/icons8-telegram-app-48.png" width="30px" class="header_img" alt="" style="border-radius: 10px; "></a>
            <a href=""><img src="include/a/assets/icons8-whatsapp-48.png" width="30px" class="header_img" alt="" style="border-radius: 10px;"></a>
            <a href=""><img src="include/a/assets/icons8-instagram-24.png" width="30px" class="header_img" alt="" style="border-radius: 10px;"></a>
        </div>
        

    </div>';
}

?>
    <nav class="header">
 
        <h1 style="color: aqua;"><img src="include/a/assets/logo.jpeg" width="30px" class="header_img" alt="" style="border-radius: 10px; ">  Clinic Management System </h1>
                
        <ul class="nav2">
            <?php
                if(isset($_SESSION['admin'])){
                    $user=$_SESSION['admin'];
                    echo"
                        <li><a href='index.php' style='text-decoration: none;'>Dashboard</a></li>
                        <li>$user</li>
                        <li><a href='logout.php'>logout</a></li>
                        
                    ";
                }elseif(isset($_SESSION['doctor'])){
                    $user=$_SESSION['doctor'];
                    echo"
                        <li><a href='index.php' >Dashboard</a></li>
                        <li>$user</li>
                        <li><a href='logout.php'>logout</a></li>
                        
                    ";
                }elseif(isset($_SESSION['patient'])){
                    $user=$_SESSION['patient'];
                    echo"
                        <li><a href='index.php' >Dashboard</a></li>
                        <li>$user</li>
                        <li><a href='logout.php'>logout</a></li>
                        
                    ";
                }elseif(isset($_SESSION['pharmacy'])){
                    $user=$_SESSION['pharmacy'];
                    echo"
                        <li><a href='index.php' >Dashboard</a></li>
                        <li>$user</li>
                        <li><a href='logout.php'>logout</a></li>
                        
                    ";
                }else{
                    echo'
                        <li><a href="index.php" >Home</a></li>
                        <li><a href="admin.php" >Admin</a></li>
                        <li><a href="doctor.php">Doctor</a></li>
                        <li><a href="patient.php">Patient</a></li>
                   
                    ';
                }
            ?>
        </ul>


    </nav>
    <?php
    if(!isset($_SESSION["patient"])&&!isset($_SESSION["doctor"])&&!isset($_SESSION["admin"])&&!isset($_SESSION["pharmacy"])){
        echo "
    <div class='nav_bottom1'>
        <div style='width: 120px;background:#555;border-radius:10px'>
            <p style='margin-top:10px; margin-bottom:5px; font-size:10px; margin-left:15px ;color:aqua;'>Sign Up Here <a href=''><i class='fa-solid fa-arrow-right-to-arc'></i></i></a></p>
        </div>
        <button style='width:110px'><a href='sign-ind.php'><i class='fa fa-user-md' aria-hidden='true'></i> Doctor</a></button>
        <button style='width:110px'><a href='sign-inp.php'><i class='fa fa-heartbeat' aria-hidden='true'></i> Patient</a></button>
        <button style='width:150px ;'><a href='sign-upp.php'><i class='fas fa-user-nurse'></i> Pharmacist</a></button>
        <button style='width:150px ; margin-left:40%'><a href='pharmacy.php'><i class='fa fa-medkit' aria-hidden='true'></i> Pharmacy</a></button>";
    } 
    ?>
    </div>
</body>
</html>
