

<?php
include 'fragmentSearchResult.php';
?>
<html>
    <head>
        <title>The Traval Car</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="project.js"></script>
        <style>
            .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: arial;
          }

         
        </style>
    
    </head>
</html>
<body>
    <div class="container">
        <?php include 'fragmentMenuHome.html'; ?>
        <p>
        <br>
        <br>
        <?php ?>
            <div class='row'>
                
                <?php
                    //label,adress,airport.name,rest_places,price_park
                    // La liste des vins est dans une variable $results     
                    if($results){
                        foreach ($results as $result) {
                            search_result_parking($result);
                        }
                    }else{
                        echo "Sorry we didn't find a parking lot for you ";
                    }
                ?>
            </div>

    </div>
    <?php include"fragmentFooter.html"?>

