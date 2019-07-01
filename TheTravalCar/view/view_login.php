<?php
    session_start();
    if (isset($_SESSION['username'])) {
            echo '<script>alert("You have logged in ")</script>';
            echo "<script type='text/javascript'>history.go(-1)</script>";
    } else {
            
?>
<html>
    <head>
        <title>The Traval Car</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../js/project.js"></script>
        <html lang="en">
        <style type="text/css">

            body{
                height: 100%;
                background-image: url('../image/car.jpg');
                background-position: center center;
                background-repeat: no-repeat; 
                background-size: cover;
                min-height: 100vh;
                width:100%;
                height:1024px;
            }  /*这里很关键*/

            .outer-wrap{
                /*只有同时为html和body设置height: 100%时，这里的height才生效，
                并且随浏览器窗口变化始终保持和浏览器视窗等高*/
                height: 100%;    
                position: relative;
            }
            .login-panel{
                width: 400px;
                height: 300px;
                background-color: rgba(0, 0, 0, .5);
                position: absolute;
                top: 50%;
                left: 50%;
                margin-top: -150px;
                margin-left: -200px;
            }

            fieldset{

                border: none;
                border-radius: 2px;
                margin-bottom: 12px;
                overflow: hidden;
                padding: 0 .625em;
            }

            label{
                cursor: pointer;
                display: inline-block;
                padding: 3px 6px;
                text-align: right;
                width: 150px;
                vertical-align: top;
            }

            input{
                font-size: inherit;
            }

        </style>
      
    </head>   
    <body>
        
        <nav class="navbar navbar-fixed-top">
            <div class="navbar-header">
                <img src="../image/brand.jpg">
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li ><a href="view_sign_up.php" style="color: black"><span class="glyphicon glyphicon-user"></span><strong>Sign Up</strong></a></li>
                <li><a href="view_login.php" style="color: black"><span class="glyphicon glyphicon-log-in"></span><strong> Log in</strong></a></li>
            </ul>
        </nav>
        
            <div class="outer-wrap">
                <div class="login-panel">
                    <form action="../controller/router.php?action=loginCheck" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <label for="username" style="color:AntiqueWhite;text-align:left"><strong>Username:</strong></label>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="username" type="text" class="form-control" name="username" value="" placeholder="email" required>                                        
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" style="color:AntiqueWhite;text-align:left"><strong>Password:</strong></label>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="password" required>
                                </div>

                            </div>
                            
                            <div class="form-group" align="center">
                                <button type="submit" class="btn btn-primary" style='text-align:center'>Submit</button>
                            </div>
                            
                        </fieldset>
                    </form>

                    <div align="center">
                        <p style="color:antiquewhite"><font size="4">Don't have an account?</font></p>
                        <a href='../view/view_sign_up.php' style="color:DodgerBlue "><font size="3">Sign Up</font></a>
                    </div>
                </div>
            </div>
        
            <?php 
                include"fragmentFooter.html" 
            ?>
    <?php
        }
    ?>
