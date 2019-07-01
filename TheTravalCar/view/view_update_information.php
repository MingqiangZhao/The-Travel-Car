<?php
session_start();

$query_string = $_SERVER['QUERY_STRING'];
parse_str($query_string, $param);
$name = $param["name"];
$value = $param["value"];
include 'fragmentHeader.html';
?>
<body>
    <?php include'fragmentMenuHome.html'?>
    <p>
    <div class="container">
        <div class="row">
            <?php include'fragmentMenuUser.html' ?>

                <div class="col-md-9">
                    <a class="list-group-item active"><h3>Update your information</h3></a>
                    <br>
                    <br>
                    <form role="form" method='post' action='../controller/router.php?action=userUpdateInformation'>
                        <div class="form-group" style="position: center">
                            <fieldset>
                                <input type="hidden" name='action' value='userUpdateInformation'>
                                <input type="hidden" name='name' value='<?php echo $name; ?>'>
                                <div class="form-group">
                                    <label for="username"><font size="4"><?php echo $name; ?>:</font></label>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="value" type="text" class="form-control" name="value" placeholder="<?php echo $value; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group" align="center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </fieldset>
                        </div>
                    </form>
               </div>
        </div>
    </div>
    
<?php include'fragmentFooter.html'?>
