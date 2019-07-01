<?php
    session_start();
    
    if(isset($_SESSION['username'])&&isset($_SESSION['password'])
            &&isset($_SESSION['name']) &&isset($_SESSION['gender'])
            &&isset($_SESSION['nationality'])&&isset($_SESSION['wallet'])){
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $name = $_SESSION['name'];
        $gender = $_SESSION['gender'];
        $nationality = $_SESSION['nationality'];
        $wallet = $_SESSION['wallet'];
    }else{
        exit();
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
                        <a class="list-group-item active"><h3>Personal Information</h3></a>
                        <div class="list-group-item">
                            <h3 class="list-group-item-heading" style="color:black;text-align:center" >Profile</h3>                        
                            <hr>
                            <div>
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <a href="view_update_information.php?name=name&value=<?php echo $name?>">NAME:<span style="margin-left: 100"><?php echo $name; ?></span>
                                            <span class="glyphicon glyphicon-chevron-right" style="float:right"></span>
                                        </a>
                                        
                                    </li>
                                    
                                    <hr>
                                    <li>
                                        <a href="view_update_information.php?name=username&value=<?php echo $username?>">USERNAME:<span style="margin-left: 60"><?php echo $username; ?></span>
                                            <span class="glyphicon glyphicon-chevron-right" style="float:right"></span>
                                        </a>
                                    </li>
                                    
                                    <hr>
                                    <li>
                                        <a href="view_update_information.php?name=password&value=<?php echo $password?>">PASSWORD:<span style="margin-left: 60">.........
                                                <span class="glyphicon glyphicon-chevron-right" style="float:right"></span>
                                        </a>
                                    </li>
                                    
                                    <hr>
                                    <li>
                                        <a href="view_update_information.php?name=gender&value=<?php echo $gender?>">GENDER:<span style="margin-left: 90"><?php echo $gender; ?>
                                            <span class="glyphicon glyphicon-chevron-right" style="float:right"></span>
                                        </a>
                                    </li>
                                    
                                    <hr>
                                    <li>
                                        <a href="view_update_information.php?name=nationality&value=<?php echo $nationality?>">NATIONALITY:<span style="margin-left: 55"><?php echo $nationality; ?>
                                            <span class="glyphicon glyphicon-chevron-right" style="float:right"></span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                           
                            
                        </div>
                    </ul>
               </div>
            
        </div>
    </div>
    
<?php include'fragmentFooter.html'?>