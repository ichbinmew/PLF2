<?php

    $lieblingsfach = $_GET['lieblingsfach'];
    $lieblingslehrer = $_GET['lieblingslehrer'];
    echo "<h1>Lieblingsfach ".$lieblingsfach."</h1>";
    echo "<br>";
    echo "Mein Lieblingslehrer ist ".strtoupper($lieblingslehrer);
    echo "<br><br>";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "3AI";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }

    $sql = "SELECT DISTINCT Langbeschreibung FROM Fach_SCH WHERE Kurzbezeichnung = '$lieblingslehrer'";
    $result = $conn->query($sql);

    $row_count = $result->num_rows;
    if($row_count == 1){
        echo "Sein Fach ist ";
    } else {
        echo "Seine Fächer sind ";
    }
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $i++;
        echo $row['Langbeschreibung'];
        if ($i == $row_count) {
            echo "!";
        } else {
            echo ", ";
        }
    }

?>
