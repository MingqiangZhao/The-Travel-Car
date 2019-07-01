<html>
    <head>
        <title>The Traval Car</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap.css" rel="stylesheet"/>
        
        <link href="project.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="project.js"></script>
        <script type="text/javascript">
            var isCommitted = false;
            function dosubmit(){
                if(isCommitted==false){
                   isCommitted = true;
                   return true;
               }else{
                   return false;
               }
           }
           var show = false;
            function hideLayer(id) {
                var obj = document.getElementById(id);
                obj.style.display = "none";
            }

            function showForm(id) {
             var obj  = document.getElementById(id);
               if(!show){
                obj.style.display = "inline-block";
                   show = true;
                }else{
                    obj.style.display = "none";
                    show = false;
                }
             }
        </script>
        <style>
            #add_parkingLot{
                display: none;
            }
        </style>
    </head>  
<body>
    <?php include'fragmentManagerHome.html'?>
    <br>
            <?php include'fragmentManagerUser.html' ?>
            <div class="col-md-10">
                <br>
                <div class='panel'>
                    <div class="panel-heading " >
                        <p><h3><strong>Operation parking lot:</strong></h3></p>
                        <hr>
                        <br>
                        <p><a onclick="showForm('add_parkingLot')"> <h4><strong>Add a new parking lot</strong></h4></a></p>
                        <br>
                        <div style="width:60%;float: center" >
                        <form id="add_parkingLot" role="form" method='post' action='router.php?action=add_parking_lot'>
                                 <div class="form-group" style="float: left">
                                    <fieldset>
                                        <input type="hidden" name='action' value='add_parking_lot'>
                                       
                                        <div class="form-group" align="left">
                                            <label for="code"><font size="4">Airport code:</font></label>
                                            <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input id="value" type="text" class="form-control" name="code" required>
                                            </div>
                                        </div>

                                        <div class="form-group" align="left">
                                            <label for="label"><font size="4">Label:</font></label>
                                            <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input id="value" type="text" class="form-control" name="label" required>
                                            </div>
                                        </div>

                                        <div class="form-group" align="left">
                                            <label for="adress"><font size="4">Adress:</font></label>
                                            <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input id="value" type="text" class="form-control" name="adress" required>
                                            </div>
                                        </div>
                                        <div class="form-group" align="left">
                                            <label for="rest_places"><font size="4">Rest Places:</font></label>
                                            <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input id="value" type="text" class="form-control" name="rest_places" required>
                                            </div>
                                        </div>
                                        <div class="form-group" align="left">
                                            <label for="adress"><font size="4">price_park:</font></label>
                                            <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input id="value" type="text" class="form-control" name="price_park" required>
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
                    <div class="panel-body" >
                         <p><h4><strong>Parking Lot List:</strong></h4></p>
                                <table class = "table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope = "col">Park Id</th>
                                            <th scope = "col">Airport Code</th>
                                            <th scope = "col">Label</th>
                                            <th scope = "col">Adress</th>
                                            <th scope = "col">Rest Places</th>
                                            <th scope = "col">Price</th>
                                            <th scope="col">Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // La liste des vins est dans une variable $results             
                                        foreach ($parking_lot_list as $result) {
                                            printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%.2f</td>", 
                                            $result['parkId'], $result['code'], $result['label'], $result['adress'],$result['rest_places'],
                                                   $result['price_park']);
                                            echo '<td>
                                                        <form role="form" method="post" action="../controller/router.php?action=delete_parking_lot&&parkId='.$result['parkId'].'" >
                                                                <input type="hidden" name="action" value="cancelMyOrder_park">
                                                                <input type="hidden" name="parkId" value="'.$result['parkId'].'">
                                                                <button type="submit"  style="color:red;">Delete</button>
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
    
<?php include'fragmentFooter.html'?>


