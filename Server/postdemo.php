<?php
//Creates new record as per request
    //Connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "beeproject";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }
    echo "good connection";
    //Get current date and time
    date_default_timezone_set('Europe/Lisbon');
    $d = date("Y-m-d");
    //echo " Date:".$d."<BR>";
    $t = date("H:i:s");
    
    echo $d; 
    echo "→";
    echo $t;

    if(!empty($_POST['idbeekeper']) && !empty($_POST['idhive']) && !empty($_POST['temperature']) && !empty($_POST['humidity']) && !empty($_POST['weight']))
    {
    	$idbeekeper = $_POST['idbeekeper'];
    	$idhive = $_POST['idhive'];
    	$temperature = $_POST['temperature'];
    	$humidity = $_POST['humidity'];
    	$weight = $_POST['weight'];
        echo $idhive;
        echo $temperature;
        echo $humidity;
        echo $weight;



	    $sql = "INSERT INTO measure (id_beekeper, id_hive, temperature, humidity, weight, date, time)
		
		VALUES ('".$idbeekeper."','".$idhive."', '".$temperature."', '".$humidity."', '".$weight."', '".$d."', '".$t."')";

		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}

	$conn->close();
?>
