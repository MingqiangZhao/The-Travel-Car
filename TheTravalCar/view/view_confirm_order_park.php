<?php
include 'fragmentHeader.html';
?>
<body>
    <?php include 'fragmentMenuHome.html'; ?>
    <div class="container">
        
        <div class='panel panel-primary'>
                <div class="panel-heading">
                    <h3>Confirm your order</h3>
                </div>
                <div class="panel-body">
                    <hr>
                    <p> Airport Info</p>
                    <table class = "table table-striped table-bordered">
                        <tr>
                            <td>Airport:</td>
                            <td><?php echo $results['name'] ?></td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td><?php echo $results['country'] ?></td>
                        </tr>
                        <tr>
                            <td>Code:</td>
                            <td><?php echo $results['code'] ?></td>
                        </tr>
                        
                    </table>
                    
                    <hr>
                    <p>Parking lot Info</p>
                    <table class = "table table-striped table-bordered">
                        <tr>
                            <td>Parking lot:</td>
                            <td><?php echo $results['label'] ?></td>
                        </tr>
                        <tr>
                            <td>Adresse:</td>
                            <td><?php echo $results['adress'] ?></td>
                        </tr>
                        <tr>
                            <td>Price for a day:</td>
                            <td><?php echo "$".$results['price_park'] ?></td>
                        </tr>
                    </table>
                    
                    <hr>
                    <p>Booking Info</p>
                    <table class = "table table-striped table-bordered">
                        
                        
                        <tr>
                            <td>Begin:</td>
                            <td><?php echo $_SESSION['free_time_begin'] ?></td>
                        </tr>
                        <tr>
                            <td>End:</td>
                            <td><?php echo $_SESSION['free_time_end'] ?></td>
                        </tr>
                       
                        <tr>
                            <td>Total Price:</td>
                            <td><?php echo "$".$results['price_park']*$interval ?></td>
                        </tr>
                    </table>
                    
                    <hr style="background-color: black;height: 1px">
                    <table>
                        <tr>
                            <td>Order time:</td>
                            <td><?php echo  date('Y-m-d H:i:s');?></td>
                        </tr>
                    </table>
                        
                </div>
                <div>
                    <form role="form" method="post" onsubmit="return dosubmit()" action="../controller/router.php?action=add_order_park&days=<?php echo $interval ?>&price=<?php echo $interval*$results['price_park'] ?>
                          &date=<?php echo date('Y-m-d H:i:s'); ?>&rest_places=<?php echo $results['rest_places'] ?>&begin=<?php echo $_SESSION['free_time_begin'] ?>&end=<?php echo $_SESSION['free_time_end'] ?>" >
                        <input type="hidden" name="action" value="add_order">
                        <input type="hidden" name="days" value="<?php echo $interval ?>">
                        <input type="hidden" name="price" value="<?php echo $interval*$results['price_park'] ?>">
                        <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s');?>">
                        <input type="hidden" name="rest_places" value="<?php echo $results['rest_places'] ?>">
                        <input type="hidden" name="begin" value="<?php echo $_SESSION['free_time_begin'] ?>">
                        <input type="hidden" name="end" value="<?php echo $_SESSION['free_time_end'] ?>">
                        
                        <div align="center">
                            <button type="submit" style="margin-bottom:10px;padding:10px 20px;">OK</button>
                        </div>
                    </form>
                    
                </div>
                
        </div>
        <hr>
        <p><h3>Want to cancel your order?</h3></p>
        <div align="center">
            <a href="view_park.php" style="margin-bottom: 20px;color:red">Cancel</a>
        </div>
    </div>
     <?php include 'fragmentFooter.html'; ?>