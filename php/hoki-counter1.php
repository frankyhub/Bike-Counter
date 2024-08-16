<!--
hoki-counter1.php
-->
<?php
    include_once('hoki-database.php');
    if ($_GET["readingsCount"]){
      $data = $_GET["readingsCount"];
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $readings_count = $_GET["readingsCount"];
    }
    // Zeige letzte 24h
    else {
      $readings_count = 24;
    }

    $last_reading = getLastReadings();
    $last_reading_temp = $last_reading["value1"];
    $last_reading_humi = $last_reading["value2"];
    $last_reading_time = $last_reading["reading_time"];

    // Winterzeit -1h
    //$last_reading_time = date("Y-m-d H:i:s", strtotime("$last_reading_time - 1 hours"));
    // Zeitkorrektur BlueHost
    // $last_reading_time = date("d.m.Y H:i:s", strtotime("$last_reading_time + 7 hours"));
    $last_reading_time = date("d.m.Y H:i:s", strtotime("$last_reading_time"));
    $min_temp = minReading($readings_count, 'value1');
    $max_temp = maxReading($readings_count, 'value1');
    $avg_temp = avgReading($readings_count, 'value1');

    $min_humi = minReading($readings_count, 'value2');
    $max_humi = maxReading($readings_count, 'value2');
    $avg_humi = avgReading($readings_count, 'value2');
?>

<!DOCTYPE html>
<html>
    <head><meta charset="windows-1252">

        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <header class="header">
        <font size="+3"><font face="Arial Narrow"> <b>Hoki Bike-Counter</b></font></font>
            <br><br>
        <form method="get">
            <input type="number" name="readingsCount" min="1" 
            placeholder="Zeige letzte <?php echo $readings_count; ?> Stunden">
            <input type="submit" value="UPDATE">
        </form>
    </header>
<body>
    <p>Letzte Z&aumlhler-Werte: <?php echo $last_reading_time; ?></p>
    
<?php
    echo   '<font size="+3"><font face="Arial Narrow"> <b>Bike-Bewegungen in den letzten ' . $readings_count . ' Stunden:</b></font></font>
            <br><br>
            <table cellspacing="5" cellpadding="5" id="tableReadings">
             <tr><th rowspan="2">ID</th> 
             <th rowspan="2">Ort</th> 
             <th>Z&aumlhler 1</th> 
             <th>Z&aumlhler 2</th>
             <th>Z&aumlhler 3</th>
             <th rowspan="2">Datum/Zeit<t/h></tr>
            <tr><td><b>nach Hoki</b></td>
            <td><b>nach Thann</b></td> 
            <td><b>nach Gr. Hape</b></td></tr>';
    $result = getAllReadings($readings_count);
        if ($result) {
        while ($row = $result->fetch_assoc()) {
            $row_id = $row["id"];

            $row_location = $row["location"];
            $row_value1 = $row["value1"];
	    $row_value2 = $row["value2"];
            $row_value3 = $row["value1"]-46;
            $row_reading_time = $row["reading_time"];
            // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
            //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
            // Uncomment to set timezone to + 7 hours (you can change 7 to any number)
            $row_reading_time = date("d.m.Y H:i", strtotime("$row_reading_time"));
            echo '<tr>
                    <td>' . $row_id . '</td>
                    <td>' . $row_location . '</td>
                    <td>' . $row_value1 . '</td>
                    <td>' . $row_value2 . '</td>
                    <td>' . $row_value3 . '</td>
                    <td>' . $row_reading_time . '</td>
                  </tr>';
        }
        echo '</table>';
        $result->free();
    }
?>

</body>
</html>