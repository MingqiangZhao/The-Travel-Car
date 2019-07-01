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
                        <p><h3><strong>Order List:</strong></h3></p>
                    </div>
                    <div class="panel-body">
                                <p><h3><strong>Parking Order:</strong></h3></p>
                                <table class = "table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope = "col">Order Id</th>
                                            <th scope = "col">Parking lot Label</th>
                                            <th scope = "col">Airport</th>
                                            <th scope = "col">Adress</th>
                                            <th scope = "col">Order Date</th>
                                            <th scope = "col">Begin</th>
                                            <th scope="col">End</th>
                                            <th scope = "col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // La liste des vins est dans une variable $results             
                                        foreach ($order_parking_list as $result) {
                                            printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%.2f</td>", 
                                            $result['orderId'], $result['label'], $result['name'], $result['adress'],$result['date'],
                                                    $result['begin'],$result['end'],$result['price']);
                                            /*echo '<td>
                                                        <form role="form" method="post" action="router.php?action=cancelMyOrder_park&orderId='.$result["orderId"].'&price='.$result['price'].''
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
                        
                                <hr>
                                
                                <p><h3><strong>Renting Order:</strong></h3></p>
                                <table class = "table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope = "col">Order Id</th>
                                            <th scope = "col">Owner Id</th>
                                            <th scope="col">Client</th>
                                            <th scope = "col">Car Name</th>
                                            <th scope = "col">Adress</th>
                                            <th scope = "col">Order Date</th>
                                            <th scope="col">Departure Date</th>
                                            <th scope="col">Return Date</th>
                                            <th scope = "col">Price</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // La liste des vins est dans une variable $results             
                                        foreach ($order_renting_list as $result) {
                                            printf("<tr><td>%d</td><td>%s</td><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%.2f</td>", 
                                            $result['orderId'], $result['ownerId'],$result['clientId'],$result['carName'], $result['adress'],$result['date'],
                                                    $result['departure_date'],$result['return_date'],$result['price']);
                                           /* echo '<td>
                                                        <form role="form" method="post" action="../controller/router.php?action=cancelMyOrder_rent&orderId='.$result["orderId"].'&price='.$result['price'].''
                                                    . '&parkId='.$result['parkId'].'&departure_date='.$result['departure_date'].'&return_date='.$result['return_date'].'" >
                                                                <input type="hidden" name="action" value="cancelMyOrder_rent">
                                                                <input type="hidden" name="orderId" value="'.$result['orderId'].'">
                                                                <input type="hidden" name="price" value="'.$result['price'].'">
                                                                <input type="hidden" name="parkId" value="'.$result['parkId'].'">
                                                                <input type="hidden" name="departure_date" value="'.$result['departure_date'].'">
                                                                <input type="hidden" name="return_date" value="'.$result['return_date'].'">
                                                                    
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

