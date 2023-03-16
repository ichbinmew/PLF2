<?php
    $lieblingsfach = $_GET['lieblingsfach'];
    $lieblingslehrer = $_GET['lieblingslehrer'];
    echo "<h1>Lieblingsfach " . $lieblingsfach . "</h1>";
    echo "<br>";
    echo "Mein Lieblingslehrer ist " . strtoupper($lieblingslehrer);
    echo "<br><br>";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "3AI";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT DISTINCT Langbeschreibung FROM Fach_SCH WHERE Kurzbezeichnung = :lieblingslehrer";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':lieblingslehrer', $lieblingslehrer);
        $stmt->execute();

        $row_count = $stmt->rowCount();
        if($row_count == 1){
            echo "Sein Fach ist ";
        } else {
            echo "Seine Fächer sind ";
        }
        $i = 0;
        while ($row = $stmt->fetch()) {
            $i++;
            echo $row['Langbeschreibung'];
            if ($i == $row_count) {
                echo "!";
            } else {
                echo ", ";
            }
        }

        $conn = null;
    } catch(PDOException $e) {
        echo "Verbindung fehlgeschlagen: " . $e->getMessage();
    }
?>
