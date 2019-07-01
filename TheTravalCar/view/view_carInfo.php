<?php
    if(isset($_SESSION['carId'])&&isset($_SESSION['carName'])
            &&isset($_SESSION['userId']) &&isset($_SESSION['seats'])
            &&isset($_SESSION['doors'])&&isset($_SESSION['cost_rent'])){
        $carId = $_SESSION['carId'];
        $carName = $_SESSION['carName'];
        $userId = $_SESSION['userId'];
        $seats = $_SESSION['seats'];
        $doors = $_SESSION['doors'];
        $cost_rent = $_SESSION['cost_rent'];
    }else{
        header("location:../view/view_car_inscription.php");
    }
    
    include 'fragmentHeader.html';
?>
<body>
    <?php include'fragmentMenuHome.html'?>
    <div class="container">
        <div class="row">
            <?php include'fragmentMenuUser.html' ?>
            <div class="col-md-9">
                    <ul class="list-group">
                        <a class="list-group-item active"><h3>Car Information</h3></a>
                        <div class="list-group-item">
                            <h3 class="list-group-item-heading" style="color:black;text-align:center" >MY CAR (Default)</h3>                        
                            <hr>
                            <div>
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <a href="../view/view_update_carInfo.php?name=carName&value=<?php echo $carName?>">NAME:<span style="margin-left: 150"><?php echo $carName; ?></span>
                                            <span class="glyphicon glyphicon-chevron-right" style="float:right"></span>
                                        </a>
                                        
                                    </li>
                                    
                                    <hr>
                                    <li>
                                        <a href="../view/view_update_carInfo.php?name=seats&value=<?php echo $seats?>">SEATS:<span style="margin-left: 150"><?php echo $seats; ?></span>
                                            <span class="glyphicon glyphicon-chevron-right" style="float:right"></span>
                                        </a>
                                    </li>
                                    
                                    <hr>
                                    <li>
                                        <a href="../view/view_update_carInfo.php?name=doors&value=<?php echo $doors?>">DOORS:<span style="margin-left: 142"><?php echo $doors; ?>
                                                <span class="glyphicon glyphicon-chevron-right" style="float:right"></span>
                                        </a>
                                    </li>
                                    
                                    <hr>
                                    <li>
                                        <a href="../view/view_update_carInfo.php?name=cost_rent&value=<?php echo $cost_rent?>">RENT PRICE:<span style="margin-left: 100"><?php echo $cost_rent; ?>
                                            <span class="glyphicon glyphicon-chevron-right" style="float:right"></span>
                                        </a>
                                    </li>                                  

                                </ul>
                            </div>
                            <hr>
                            <br>
                            <p><h3>Want to add a new car?</h3></p>
                                <a href="../view/view_add_new_car.php" style="margin-bottom: 20px;color:grey">Add a new car</a>
                       
                            <p><h3>or want to change your default car?</h3></p>
                                <a href="router.php?action=setDefaultCar" style="margin-bottom: 20px;color:grey;">Change default car</a>
                           
                            
                        </div>
                    </ul>
               </div>
            
        </div>
    </div>
    
<?php include'fragmentFooter.html'?>