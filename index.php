<html>
    <head>
        <title>test</title>
    </head>
    <body>
        <form action="index.php" method="post">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "3AI";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Verbindung fehlgeschlagen: " . $conn->connect_error);
            }

            echo "<input style='text-transform: uppercase; type='text' name='kurzbeschreibung' id='kurzbeschreibung' minlength='3' maxlength='3' placeholder='DAZ'>";

            echo "<br><br>";
            echo "<input type='submit' name='submit' value='OK'>";
            if (isset($_POST['submit'])) {
                $selectedOption = $_POST['kurzbeschreibung'];
                $sql = "SELECT * FROM Fach_SCH WHERE Kurzbezeichnung = '$selectedOption'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    header("Location: weiter.php?kurzbeschreibung=$selectedOption");
                } else {
                    echo "<br><br>Dieser Lehrer existiert nicht.";
                }
                exit;
            }

            $conn->close();
            ?>
        </form>
    </body>
</html>
