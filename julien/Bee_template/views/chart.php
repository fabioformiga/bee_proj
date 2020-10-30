<!DOCTYPE html>
<html>
    <head>
        <title>Bee Project - Chart </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
        require_once '../config/properties.php';        
        require_once 'header.php'; 
        ?>
        <script src="js/chart/chart.js"></script>
    </head>
    <body>
        <div class="container" id="chart_container">
            <div class="row">
                <div class="col col-lg-2">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" id="dropdown_date_title" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Year</button>
                        <div class="dropdown-menu" id="dropdown_date" aria-labelledby="dropdownMenuButton">
                            <button class="dropdown-item" type="button" onclick="FilterChart('date', 'Week')">Week</button>
                            <button class="dropdown-item" type="button" onclick="FilterChart('date', 'Month')">Month</button>
                            <button class="dropdown-item" type="button" onclick="FilterChart('date', 'Year')">Year</button>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-2">
                    <div class="dropdown" id="dropdown_local_container">
                        <button class="btn btn-secondary dropdown-toggle" id="local" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Local</button>
                        <div class="dropdown-menu" id="dropdown_local" aria-labelledby="dropdownMenuButton">
                        </div>
                    </div> 
                </div>
                <div class="col col-lg-2">
                    <div class="dropdown" id="dropdown_hive_container">
                        <button class="btn btn-secondary dropdown-toggle" id="hive" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hive</button>
                        <div class="dropdown-menu" id="dropdown_hive" aria-labelledby="dropdownMenuButton">
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div id="chart_div" style="width: 900px; height: 400px"></div>
            </div>
        </div>
    <?php 
        require_once 'footer.php';
    ?>    
        
    </body>
</html>
