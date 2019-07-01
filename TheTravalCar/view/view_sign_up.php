<?php
include 'fragmentHeader.html';
?>
<body>
    <div class="container">
        <nav class="navbar navbar-fixed-top">
            <div class="navbar-header">
                <img src="../image/brand.jpg">
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li ><a href="view_sign_up.php" style="color: black"><span class="glyphicon glyphicon-user"></span><strong>Sign Up</strong></a></li>
                <li><a href="view_login.php" style="color: black"><span class="glyphicon glyphicon-log-in"></span><strong> Log in</strong></a></li>
            </ul>
        </nav>
        <p>
        <div class="jumbotron" style="color: white">
            <h2 style="color: black">Welcome to The Travel Car !</h2>
        </div>

        <form role="form" method='post' action='../controller/router.php?action=inscription'>
            <div class="form-group" style="position: center">
                <fieldset>
                    <input type="hidden" name='action' value='inscription'>
                    <div class="form-group">
                        <label for="username"><font size="4">Username:</font></label>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="username" type="text" class="form-control" name="username" placeholder="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password"><font size="4">Password:</font></label>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password" placeholder="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name"><font size="4">Name:</font></label>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="name" type="text" class="form-control" name="name" placeholder="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender"><font size="4">Gender:</font></label>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="gender" type="text" class="form-control" name="gender" placeholder="gender" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nationality"><font size="4">Nationality:</font></label>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                            <input id="nationality" type="text" class="form-control" name="nationality" placeholder="nationality" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="wallet"><font size="4">Wallet:</font></label>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                            <input id="wallet" type="text" class="form-control" name="wallet" placeholder="money" required>
                        </div>
                    </div>
                    <div class="form-group" align="center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
               </fieldset>

            </div>
        </form>
    </div>
    <?php include"fragmentFooter.html"?>
