<!--
hoki-counter1.php
-->
<?php

    include_once('hoki-database.php');

    if (1 > 0){
      $data = $_GET["readingsCount"];
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $readings_count = $_GET["readingsCount"];
    };
  
    
    //Lese Counter aus
    $last_reading = getLastReadings();
    $count1 = $last_reading["value1"];
    $count2 = $last_reading["value2"];
    $last_reading_time = $last_reading["reading_time"];

    //Zeitkorrektur
//    $eurozeit = date("d.m.Y H:i:s", strtotime("$last_reading_time - 1 hours"));
      $eurozeit = date("d.m.Y H:i", strtotime("$last_reading_time"));
//    $l_eintrag = date("d.m.Y H:i", strtotime("$last_reading_time - 1 hours")); 
      $l_eintrag = date("d.m.Y H:i", strtotime("$last_reading_time"));
      $heute = date("d.m.Y", strtotime("$last_reading_time"));
    
    // Zeige letzte:
    $readings_count = 24;
    
    //min max Counter-Variablen
    //$min_temp = minReading($readings_count, 'value1');
    $min_temp = $count1;
    $max_temp = maxReading($readings_count, 'value1');
    $avg_temp = avgReading($readings_count, 'value1');

    //-----------------------------


?>

<!DOCTYPE html>
<html>

    <header class="header">
        <meta http-equiv="refresh" content="30" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <font size="+3"><font face="Arial Narrow"> <b>Hoki Bike-Counter Auswertung</b></font></font>
            <br><br>
    </header>
<body>
<p>Datum: <?php echo $heute;?></p>

<p>Letzter Datenbank-Eintrag am: 
<?php echo $l_eintrag; ?> Uhr.</p>

<p>Letzter Z&aumlhlerstand, Radfahrer in Richtung Hoki: 
<?php echo $count1;?></p>

<?php
$date = date("d.m.Y");



echo "<br>";
echo "<br>";
echo "Max-Wert heute: ";
echo $min_temp;
echo "<br>";
echo "<br>";
echo "Min-Wert: ";
echo $max_temp['max_amount'];
echo "<br>";
echo "<br>";



//echo "Werte der letzten $readings_count Durchfahrten";
$d_heute =  $min_temp - $max_temp['max_amount'];
echo "<b>Durchfahrten in den letzten $readings_count Stunden: </b>";
$d_heute = "<b>$d_heute</b>";
echo $d_heute;

echo "<br>";
echo "<br>";



?>

        <form method="get">
        <input type="submit" value="UPDATE">
        </form>


</body>
</html>