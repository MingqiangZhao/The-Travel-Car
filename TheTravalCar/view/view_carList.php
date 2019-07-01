<?php
    include 'fragmentHeader.html';
?>
<body>
    <?php include'fragmentManagerHome.html'?>
    <br>
            <?php include'fragmentManagerUser.html' ?>
            <div class="col-md-10">
                <br>
                <div class='panel'>
                    <div class="panel-heading " >
                        <p><h3><strong>Car List:</strong></h3></p>
                    </div>
                    <div class="panel-body">
                                <table class = "table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope = "col">Car Id</th>
                                            <th scope = "col">Car Name</th>
                                            <th scope = "col">User Id</th>
                                            <th scope = "col">Seats</th>
                                            <th scope = "col">Doors</th>
                                            <th scope = "col">Price</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // La liste des vins est dans une variable $results             
                                        foreach ($carList as $result) {
                                            printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%.2f</td>", 
                                            $result['carId'], $result['carName'], $result['userId'], $result['seats'],$result['doors'],
                                                    $result['cost_rent']);
                                            /*echo '<td>
                                                        <form role="form" method="post" action="../controller/router.php?action=cancelMyOrder_park&orderId='.$result["orderId"].'&price='.$result['price'].''
                                                    . '&parkId='.$result['parkId'].'&rest_places='.$result['rest_places'].'" >
                                                                <input type="hidden" name="action" value="cancelMyOrder_park">
                                                                <input type="hidden" name="orderId" value="'.$result['orderId'].'">
                                                                <input type="hidden" name="price" value="'.$result['price'].'">
                                                                <input type="hidden" name="parkId" value="'.$result['parkId'].'">
                                                                <input type="hidden" name="rest_places" value="'.$result['rest_places'].'">
                                                                <button type="submit" onlick="alert("Attention! You will be punished with half of the price of parking !!! ")" style="color:red;">cancel</button>
                                                        </form>
                                                  </td>';*/
                                      
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
        </div>
    </div>
    
<?php include'fragmentFooter.html'?>

