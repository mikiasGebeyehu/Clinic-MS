<?php
session_start();

include("../include/connection.php");

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $entdate = $_POST['entdate'];
    $expdate = $_POST['expdate'];
    $pharm = $_POST['pharm'];
    $fee = $_POST['fee'];
    $quan = $_POST['quan'];
    $des = $_POST['des'];

    $error = array();
    if (empty($name)&&empty($id)) {
        $error['X'] = 'Enter medicine name and id';
    } elseif (empty($expdate)&&empty($pharm)) {
        $error['X'] = 'Enter expire date and pharmacist name';
    }

    if (count($error) == 0) {
        
        $sql = "INSERT INTO `pharmacy`(`medicine_id`, `medicine_name`, `date_enter`, `expire_date`, `pharmacist_rec`, `amount`, `quantity`, `description`) VALUES('$id','$name','$entdate','$expdate','$pharm','$fee','$quan','$des')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $error['X'] = 'You can enter medicine successfully';
        }else{
            $error['X'] = "You can't enter medicine successfully";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Add Admin</title>
    <style>
        body {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);
            font-family: 'Poppins', sans-serif;
        }
        form {
            border-radius: 20px;
            margin-top: 150px !important;
            width: 35% !important;
            height: 50% !important;
            background-color: white !important;
            padding: 50px;
        }
        .btn-primary {
            width: 100%;
            border: none;
            border-radius: 50px;
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);
        }
        .form-control {
            color: rgba(0,0,0,.87);
            border-bottom-color: rgba(0,0,0,.42);
            box-shadow: none !important;
            border: none;
            border-bottom: 1px solid;
            border-radius: 4px 4px 0 0;
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
<form class="mx-auto" action="amedicine.php" method="post">
    <h3 class="text-center">Add medication</h3>

    <div class="mb-3 mt-5">
        <label for="exampleInputEmail1" class="form-label"> Medicine ID</label>
        <input type="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="id">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Medicine Name</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="name">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Enterance Date</label>
        <input type="date" class="form-control" id="exampleInputPassword1" name="entdate">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Expiration Date</label>
        <input type="date" class="form-control" id="exampleInputPassword1" name="expdate">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">pahrmacist who recieved the medicine</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="pharm">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">value of medicine in birr</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="fee">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Quantity that recieved</label>
        <input type="number" class="form-control" id="exampleInputPassword1" name="quan">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="des">
    </div>
    <div class="mb-3">
        <?php
        if (isset($error['X'])) {
            $show = $error['X'];
            echo "<div class='alert alert-success'><h3>$show</h3></div>";
        }
        ?>
    </div>

    <button type="submit" class="btn btn-primary" name="submit">Add</button>
</form>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php
require("../include/footer.php");
?>
</body>
</html>
