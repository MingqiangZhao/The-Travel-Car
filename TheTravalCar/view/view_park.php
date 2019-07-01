<?php
include 'fragmentHeader.html';
?>
<body>
    <div class="container">
        <?php include 'fragmentMenuHome.html'; ?>
       <p>
        <div class="jumbotron" style="color: white">
            <h2 style="color: black">Search a parking lot for you ..........</h2>
        </div>

        <form role="form" method='post' action='../controller/router.php?action=search_parking_lot'>
            <div class="form-group" style="position: center">
                <fieldset>
                    <input type="hidden" name='action' value='search_parking_lot'>
                    <div class="form-group">
                        <label for="airport"><font size="4">Airport:</font></label>
                        <input type="text" class="form-control" name="code"  required>
                    </div>
                    
                    <label for="date"><font size="4">Date:</font></label>
                    <div class="form-group">
                        <label for="dateB">Beginning:</label>
            
                        
                        <input type="date" class="form-control" name="free_time_begin" required>
                     </div>   
                    
                    <div class="form-group">   
                        <label for="dateE">Ending:</label>
                        <input type="date" class="form-control" name="free_time_end" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon glyphicon-search"></span> Search</button>
                    </div>
               </fieldset>

            </div>
        </form>
        <p>
    </div>
<?php include 'fragmentFooter.html'; ?>

