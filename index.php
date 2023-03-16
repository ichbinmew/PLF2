<html>
    <head>
        <title>PLF2</title>
    </head>
    <body>
        <form action="index.php" method="post">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "3AI";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                echo "<input style='text-transform: uppercase;' type='text' name='kurzbeschreibung' id='kurzbeschreibung' minlength='3' maxlength='3' placeholder='DAZ'>";

                echo "<br><br>";
                echo "<input type='submit' name='submit' value='OK'>";
                if (isset($_POST['submit'])) {
                    $selectedOption = $_POST['kurzbeschreibung'];
                    $sql = "SELECT * FROM Fach_SCH WHERE Kurzbezeichnung = '$selectedOption'";
                    $result = $conn->query($sql);
                    if ($result->rowCount() > 0) {
                        header("Location: weiter.php?kurzbeschreibung=$selectedOption");
                    } else {
                        echo "<br><br>Dieser Lehrer existiert nicht.";
                    }
                    exit;
                }

                $conn = null;
            } catch(PDOException $e) {
                echo "Verbindung fehlgeschlagen: " . $e->getMessage();
            }
            ?>
        </form>
    </body>
</html>
