<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="description" content="Web application development"/>
        <meta name="keywords" content="PHP"/>
        <meta name="author" content="Luu Tuan Hoang"/>
        <title>Web Programming - Lab10</title>
    </head>
    <body>
        <h1>Hit Counter</h1>
        <?php
            require_once("hitcounter.php");
            umask(0007);
            $directory = "../../data/lab10";
            if (!file_exists($directory)) {
                echo "<p style='color: red;'>'$directory' does not exist.</p>";
            } else {
                $filename = "../../data/lab10/mykeys.txt";
                // Attempt to open the file
                $handle = @fopen($filename, "r");
                if (!$handle) {
                    echo "<p style='color: red;'>Unable to open the file.</p>";
                } else {
                    // Read database connection details from the file
                    $host = trim(fgets($handle));
                    $username = trim(fgets($handle));
                    $password = trim(fgets($handle));
                    $dbname = trim(fgets($handle));
                    fclose($handle);

                    // Create HitCounter object and reset hits
                    $Counter = new HitCounter($host, $username, $password, $dbname);
                    $Counter->startOver();
                    $Counter->closeConnection();

                    // Redirect to countvisits.php
                    header("Location: countvisits.php");
                    exit; // Ensure no further output is sent
                }
            }
        ?>
        <p><a href="startover.php">Start Over</a></p>
    </body>
</html>
