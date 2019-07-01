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
                        <p><h3><strong>Car Parked List:</strong></h3></p>
                    </div>
                    <div class="panel-body">
                                <table class = "table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Car Parked Id</th>
                                            <th scope = "col">Park Id</th>
                                            <th scope = "col">Car Id</th>
                                            <th scope = "col">User Id</th>
                                            <th scope = "col">Free Time Begin</th>
                                            <th scope = "col">Free Time End</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // La liste des vins est dans une variable $results             
                                        foreach ($car_parked_list as $result) {
                                            printf("<tr><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%s</td><td>%s</td>", 
                                            $result['car_parked_id'], $result['parkId'], $result['carId'], $result['userId'],$result['free_time_begin'],
                                                    $result['free_time_end']);
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

