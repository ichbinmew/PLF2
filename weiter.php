<?php
session_start();
if(isset($_GET['kurzbeschreibung'])) {
$_SESSION['lieblingslehrer'] = $_GET['kurzbeschreibung'];
}
if (isset($_GET['submit'])) {
    $lieblingsfach = $_GET['lieblingsfach'];
    $lieblingslehrer = $_SESSION['lieblingslehrer'];
    header("Location: ende.php?lieblingsfach=$lieblingsfach&lieblingslehrer=$lieblingslehrer");
}
?>
<html>
<head>
    <title>test</title>
</head>
<body>
    <form action="weiter.php" method="GET">
        <?php
        if(isset($_GET['kurzbeschreibung'])) {
            $kurzbeschreibung = $_GET['kurzbeschreibung'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "3AI";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT DISTINCT Langbeschreibung FROM Fach_SCH WHERE Kurzbezeichnung = '$kurzbeschreibung'";
                $result = $conn->query($sql);

                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch()) {
                        echo "<input type='radio' name='lieblingsfach' value='" . $row['Langbeschreibung'] . "'>" . $row['Langbeschreibung'] . "<br>";
                    }
                } else {
                    echo "Keine Datensätze gefunden.";
                }
                echo "<br>";

                echo "<input type='submit' name='submit' value='OK'>";

                $conn = null;
            }
            catch(PDOException $e) {
                echo "Verbindung fehlgeschlagen: " . $e->getMessage();
            }
        }
        ?>
    </form>
</body>
</html>