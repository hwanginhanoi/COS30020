<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Luu Tuan Hoang" />
        <title>Web Programming - Lab10</title>
    </head>
    <body>
        <h1>Web Programming - Lab10</h1>
        <form method="post">
            <p>
                <label for="dbUsername">Database Username:</label>
                <input id="dbUsername" name="dbUsername" />
            </p>
            <p>
                <label for="dbPassword">Database Password:</label>
                <input id="dbPassword" name="dbPassword" type="password" />
            </p>
            <p>
                <label for="dbName">Database Name:</label>
                <input id="dbName" name="dbName" />
            </p>
            <p>
                <input type="submit" value="Set Up" />
                <input type="reset" value="Reset" />
            </p>
        </form>
    </body>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dbHost = "feenix-mariadb.swin.edu.au";

            if (!empty($_POST["dbUsername"]) && !empty($_POST["dbPassword"]) && !empty($_POST["dbName"])) {
                $dbUsername = $_POST["dbUsername"];
                $dbPassword = $_POST["dbPassword"];
                $dbName = $_POST["dbName"];
                $dbConnection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                if ($dbConnection->connect_error) {
                    die("<p style='color: red;'>Unable to connect to the database server.</p>"
                        . "<p>Error code " . $dbConnection->connect_errno
                        . ": " . $dbConnection->connect_error . "</p>");
                } else {
                    $tableName = "hitcounter";
                    $sqlCreateTable = "CREATE TABLE $tableName ( `id` SMALLINT NOT NULL PRIMARY KEY, `hits` SMALLINT NOT NULL );";
                    $sqlInsertData = "INSERT INTO $tableName VALUES (1,0);";

                    $queryResult = $dbConnection->query($sqlCreateTable)
                    or die("<p style='color: red;'>Unable to execute the query.</p>"
                        . "<p>Error code " . $dbConnection->errno
                        . ": " . $dbConnection->error . "</p>");

                    $queryResult = $dbConnection->query($sqlInsertData)
                    or die("<p style='color: red;'>Unable to execute the query.</p>"
                        . "<p>Error code " . $dbConnection->errno
                        . ": " . $dbConnection->error . "</p>");

                    echo "<p style='color: green;'>Database setup successful.</p>";

                    umask(0007);
                    $directory = "../../data/lab10";
                    if (!file_exists($directory)) {
                        mkdir($directory, 02770);
                    }
                    $filename = "../../data/lab10/mykeys.txt";
                    $handle = fopen($filename, "w");
                    if (!$handle) {
                        echo "<p style='color: red;'>Unable to open the file.</p>";
                    } else {
                        $data = $dbHost . "\n" . $dbUsername . "\n" . $dbPassword . "\n" . $dbName . "\n";
                        fwrite($handle, $data);
                        fclose($handle);
                        echo "<p style='color: green;'>Database connection details written to file.</p>";
                        echo "<p style='color: green;'><a href='countvisits.php'>Count Visits</a></p>";
                    }
                }
                $dbConnection->close();
            } else {
                echo "<p style='color: red;'>Please provide all database connection details.</p>";
            }
        }

    ?>
</html>