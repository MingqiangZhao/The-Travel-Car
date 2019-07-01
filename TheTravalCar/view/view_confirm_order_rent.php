<?php
include 'fragmentHeader.html';
?>
<body>
    <div class="container">
        <?php include 'fragmentMenuHome.html'; ?>
        <div class='panel panel-primary'>
                <div class="panel-heading">
                    <h3>Confirm your order</h3>
                </div>
                <div class="panel-body">
                    
                    <hr>
                    <p><strong>Parking lot Info</strong></p>
                    <table class = "table table-striped table-bordered">
                        <tr>
                            <td>Airport:</td>
                            <td><?php echo $results['name'] ?></td>
                        </tr>
                        <tr>
                            <td>Airport Code:</td>
                            <td><?php echo $results['code'] ?></td>
                        </tr>
                        <tr>
                            <td>Label:</td>
                            <td><?php echo $results['label'] ?></td>
                        </tr>
                        <tr>
                            <td>Adress:</td>
                            <td><?php echo $results['adress'] ?></td>
                        </tr>
                        
                    </table>
                    
                    <hr>
                    <p><strong>Car Info</strong></p>
                    <table class = "table table-striped table-bordered">
                        <tr>
                            <td>Name:</td>
                            <td><?php echo $results['carName'] ?></td>
                        </tr>
                        <tr>
                            <td>Doors:</td>
                            <td><?php echo $results['doors'] ?></td>
                        </tr>
                        <tr>
                            <td>Seats:</td>
                            <td><?php echo $results['seats'] ?></td>
                        </tr>
                        <tr>
                            <td>Price for a day:</td>
                            <td><?php echo "$".$results['cost_rent'] ?></td>
                        </tr>
                    </table>
                    
                    <hr>
                    <p><strong>Rent Info</strong></p>
                    <table class = "table table-striped table-bordered">
                        
                        
                        <tr>
                            <td>Departure:</td>
                            <td><?php echo $_SESSION['departure'] ?></td>
                        </tr>
                        <tr>
                            <td>Return:</td>
                            <td><?php echo $_SESSION['return'] ?></td>
                        </tr>
                       
                        <tr>
                            <td>Total Price:</td>
                            <td><?php echo "$".$results['cost_rent']*$interval ?></td>
                        </tr>
                    </table>
                    
                    <hr style="background-color:black;height: 1px">
                    <table>
                        <tr>
                            <td>Order time:</td>
                            <td><?php echo  date('Y-m-d H:i:s');?></td>
                        </tr>
                    </table>
                        
                </div>
                <div>
                    <form role="form" method="post" onsubmit="return dosubmit()" action="../controller/router.php?action=add_order_rent&days=<?php echo $interval ?>&price=<?php echo $interval*$results['cost_rent'] ?>&date=<?php echo date('Y-m-d H:i:s'); ?>
                          &parkId=<?php echo $results['parkId'] ?>&carId=$results['carId'];<?php echo $results['parkId'] ?>&free_time_begin=<?php echo $results['free_time_begin'] ?>&free_time_end=<?php echo $results['free_time_end'] ?>&ownerId=<?php echo $results['userId'] ?>" >
                        <input type="hidden" name="action" value="add_order">
                        <input type="hidden" name="days" value="<?php echo $interval ?>">
                        <input type="hidden" name="price" value="<?php echo $interval*$results['cost_rent'] ?>">
                        <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s');?>">
                        <input type="hidden" name="parkId" value="<?php echo $results['parkId'];?>">
                        <input type="hidden" name="carId" value="<?php echo $results['carId'];?>">
                        <input type="hidden" name="free_time_begin" value="<?php echo $results['free_time_begin'] ?>">
                        <input type="hidden" name="free_time_end" value="<?php echo $results['free_time_end'] ?>">
                        <input type="hidden" name="ownerId" value="<?php echo $results['userId'] ?>">
                        
                        <div align="center">
                            <button type="submit" style="margin-bottom:10px;padding:10px 20px;">OK</button>
                        </div>
                    </form>
                    
                </div>
                
        </div>
        <hr>
        <p><h3>Want to cancel your order?</h3></p>
        <div align="center">
            <a href="view_rent.php" style="margin-bottom: 20px;color:red">Cancel</a>
        </div>
    </div>
    <?php include 'fragmentFooter.html'; ?>

