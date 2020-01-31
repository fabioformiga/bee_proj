<?php

    //The URL that we want to GET.
    $url = 'http://10.6.3.152/valor/';
    
    //Use file_get_contents to GET the URL in question.
    $contents = file_get_contents($url);
    
    //If $contents is not a boolean FALSE value.
    if($contents !== false){
        //Print out the contents.
        echo $contents . "<br />";

        $esp_value = explode(" ", $contents);
        $servername = "localhost";
        $username = "root";
        $password = "pt123PT#";
        $db_name = "beeproject_db";

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('Europe/Lisbon');
        $date = date("Y-m-d H:i:s");

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully <br />" . $date . "<br />";

        $sql = "INSERT INTO tmp_measure (type_measure, measure_value, date_measure, id_hive)
        VALUES ('temperature', \"" . $esp_value[1] . "\", \"" . $date . "\", \"" . $esp_value[0] . "\")";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully <br />";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "INSERT INTO tmp_measure (type_measure, measure_value, date_measure, id_hive)
        VALUES ('humidity', \"" . $esp_value[2] . "\", \"" . $date . "\", \"" . $esp_value[0] . "\")";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully <br />";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "INSERT INTO tmp_measure (type_measure, measure_value, date_measure, id_hive)
        VALUES ('weight', \"" . $esp_value[3] . "\", \"" . $date . "\", \"" . $esp_value[0] . "\")";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully <br />";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>
