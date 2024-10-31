<?php
    
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors-Request</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <h5 class="text-center">Requests From The Doctors</h5>
                <div id="show"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        show();
        function show() {
            $.ajax({
                url: "ajax_doctor_request.php",
                method: "POST",
                success: function(data) {
                    $("#show").html(data);
                }
            });
        }

        // Handle approve and reject actions
        $(document).on('click', '.approve', function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "update_doctor_status.php",
                method: "POST",
                data: { id: id, status: 'approved' },
                success: function(data) {
                    alert(data);
                    show();
                }
            });
        });

        $(document).on('click', '.reject', function() {
            var id = $(this).attr('id');
            ;
            $.ajax({
                url: "update_doctor_status.php",
                method: "POST",
                data: { id: id, status: 'rejected' },
                success: function(data) {
                    alert(data);
                    show();
                }
            });
        });

    });
</script>
</body>
</html>
