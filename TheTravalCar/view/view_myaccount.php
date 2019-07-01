<?php
session_start();
if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];
} else {
    exit();
}

include 'fragmentHeader.html';
?>
<body>
    <?php include'fragmentMenuHome.html'?>
    <div class="container">
        <div class="row">
            <?php include'fragmentMenuUser.html' ?>

                <div class="col-md-10">
                    
                    <div class="panel-heading" align="center">
                        <h1 class="text-dark">Welcome <?php echo $name; ?></h1>
                        <br>
                        <h5 class="text-muted">Manage your info, privacy, and security to make TheTravelCar work better for you</h5>
                    </div>
               </div>
        </div>
    </div>
    
<?php include'fragmentFooter.html'?>