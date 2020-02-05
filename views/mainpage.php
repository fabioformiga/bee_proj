<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TXT_CHART_TITLE; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            require_once '../config/properties.php';        
            require_once '../views/header.php'; 
        ?>
        <script src="<?php echo URL_JS?>/mainpage.js"></script>
        <script src="<?php echo URL_JS?>/chart/chartScript.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
            <a class="navbar-brand " href="#">Bee project</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto sidenav" id="navAccordion">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-collapse" href="#" id="hasSubItems" data-toggle="collapse" data-target="#collapseSubItems1" aria-controls="collapseSubItems1" aria-expanded="false">
                            Hives
                        </a>
                        <ul class="nav-second-level collapse" id="collapseSubItems1" data-parent="#navAccordion">
                            <li class="nav-item col-sm-10">
                                <input type="search" class="form-control form-control-sm" id="searchbar_hive" aria-describedby="hiveHelp" placeholder="Enter hive number">
                            </li>
                            <?php
                                if (is_array($hive_list) || is_object($hive_list))
                                {
                                    foreach($hive_list as $hive_name) {
                                        ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">
                                                <span class="nav-link-text hive_name"><?php echo $hive_name["name_hive"];?></span>
                                            </a>
                                        </li>
                                        <?php
                                    } 
                                }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-collapse" href="#" id="hasSubItems" data-toggle="collapse" data-target="#collapseSubItems2" aria-controls="collapseSubItems2" aria-expanded="false">
                            Charts
                        </a>
                        <ul class="nav-second-level collapse" id="collapseSubItems2" data-parent="#navAccordion">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="nav-link-text weight_chart">Weight chart</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="nav-link-text temperature_chart">Temperature chart</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="nav-link-text humidity_chart">Humidity chart</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-collapse" href="#" id="hasSubItems" data-toggle="collapse" data-target="#collapseSubItems3" aria-controls="collapseSubItems3" aria-expanded="false">
                            Users
                        </a>
                        <ul class="nav-second-level collapse" id="collapseSubItems3" data-parent="#navAccordion">
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">
                                    <span class="nav-link-text">User: <?php echo $_SESSION["username"]?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?action=disconnect">
                                    <span class="nav-link-text">Disconnect</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="nav-link-text humidity_chart">Change password</span>
                                </a>
                            </li>
                        </ul>
                    </li>

<!--                     <li class="nav-item">
                        <a class="nav-link nav-link-collapse warning_tab" href="#" id="hasSubItems" data-toggle="collapse" data-target="#collapseSubItems4" aria-controls="collapseSubItems4" aria-expanded="false">
                            Warning system <span class="badge badge-warning">4</span>
                        </a>
                        <ul class="nav-second-level collapse" id="collapseSubItems4" data-parent="#navAccordion">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="nav-link-text">Weight Threshold</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="nav-link-text">Temperature Threshold</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="nav-link-text">Humidity Threshold</span>
                                </a>
                            </li>
                        </ul>
                    </li> -->
            </ul>
        </div>
        </nav>

        <main class="content-wrapper">
        </main>

        <footer class="footer">
            <div class="container">
                <div class="text-center">
                    <span>Coded by Bee project developers, 2019</span>
                </div>
            </div>
        </footer>
    </body>
</html>