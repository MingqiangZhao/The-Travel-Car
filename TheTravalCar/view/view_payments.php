<?php
session_start();
if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];
} else {
    exit();
}

include 'fragmentHeader.html';
?>
<body>
    <?php include'fragmentMenuHome.html'?>
    <div class="container">
        <div class="row">
            <?php include'fragmentMenuUser.html' ?>

                <div class="col-md-8">
                    <div class='panel panel-primary'>
                        <div class="panel-heading " >
                            <h3>Account Balance:</h3>
                        </div>
                        <div class="panel-body">
                            <p><h4><strong>My Wallet:<?php echo "$".$_SESSION['wallet']; ?></strong></h4></p>
                            <hr style="height: 1px;background-color: black">
                            <div class="col-md-6">
                               <form role="form" method="post" action="../controller/router.php?action=recharge" >
                                    <div class="form-group">
                                        <label for="username"><font size="4">Recharge:</font></label>
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                                            <input type="text" class="form-control" name="money" required>
                                        </div>
                                    </div>
                                    <div class="form-group" align="center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>  
                        </div>
                    </div>
                    
               </div>
            
        </div>
        
    </div>
    
<?php include'fragmentFooter.html'?>
