<?php
    session_start();
    
    if(isset($_SESSION['userId'])){
        $id = $_SESSION['userId'];
    }else{
        exit();
    }
    
    include 'fragmentHeader.html';
?>
<body>
    <?php include'fragmentMenuHome.html'?>
    <p>
    <div class="container">
        <div class="row">
            <?php include'fragmentMenuUser.html' ?>
            
                <div class="col-md-9">

                    <div class="panel-heading" align="center">
                            <h1 class="text-dark">Add your car</h1>
                            <br>
                            <h5 class="text-muted">Add a car so that you can rent or park with the help of TheTravelCar</h5>
                            <br>
                            <hr>
                             <form role="form" method='post' action='../controller/router.php?action=add_a_car'>
                                 <div class="form-group" style="float: left">
                                    <fieldset>
                                        <input type="hidden" name='action' value='add_a_car'>
                                        <div class="form-group" align="left">
                                            <label for="carName"><font size="4">Name:</font></label>
                                            <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input id="value" type="text" class="form-control" name="carName" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" align="left">
                                            <label for="seats"><font size="4">Seats:</font></label>
                                            <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input id="value" type="text" class="form-control" name="seats" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" align="left">
                                            <label for="doors"><font size="4">Doors:</font></label>
                                            <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input id="value" type="text" class="form-control" name="doors" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" align="left">
                                            <label for="cost_rent"><font size="4">Cost of Renting:</font></label>
                                            <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input id="value" type="text" class="form-control" name="cost_rent" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" align="center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </fieldset>
                                </div>
                            </form>
                            
                    </div>
               </div>
        </div>
    </div>
    
<?php include'fragmentFooter.html'?>