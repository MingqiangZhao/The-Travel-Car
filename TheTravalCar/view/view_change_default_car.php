<?php
    include 'fragmentHeader.html';
?>
<body>
    <?php include'fragmentMenuHome.html'?>
    <div class="container">
        <div class="row">
            <?php include'fragmentMenuUser.html' ?>
            <div class="col-md-10">
                <div class='panel panel-primary'>
                    <div class="panel-heading " >
                        <h3>My Order List</h3>
                    </div>
                    <div class="panel-body">
                                <p><h3><strong>Parking Order:</strong></h3></p>
                                <table class = "table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope = "col">Car Id</th>
                                            <th scope = "col">Name</th>
                                            <th scope = "col">Seats</th>
                                            <th scope = "col">Doors</th>
                                            <th scope = "col">Price</th>
                                            <th scope = "col">Set default</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // La liste des vins est dans une variable $results             
                                        foreach ($results as $result) {
                                            printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%.2f</td>", 
                                            $result['carId'], $result['carName'], $result['seats'], $result['doors'],$result['cost_rent']);
                                            echo '<td>
                                                        <form role="form" method="post" action="../controller/router.php?action=updateDefaultCar&carId='.$result['carId'].'" >
                                                                <input type="hidden" name="action" value="cancelMyOrder_park">
                                                                <input type="hidden" name="carId" value="'.$result['carId'].'">
                                                                <button type="submit" style="color:red;">SET</button>
                                                        </form>
                                                  </td>';
                                      
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                        
                                
                            </div>
                </div>
                
            </div>
        </div>
    </div>
    
<?php include'fragmentFooter.html'?>

