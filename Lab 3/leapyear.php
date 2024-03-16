<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="description" content="Web Application Development :: Lab 1"/>
        <meta name="keywords" content="Web,programming"/>
        <title>Using if and while statements</title>
    </head>
    <body>
        <h1>Web Programming - Lab 3</h1>
        <?php
            $year = 2100;
            if (isset($_GET["var"]) and $_GET["var"] > 0) {
                $year = $_GET["var"];
                if (is_leapyear($year)) {
                    echo "<p style='color: green;'>The year you entered $year is a leap year. </p>";
                } else {
                    echo "<p style='color: blue'>The year you entered $year is not a leap year. </p>";
                }
            }
            else {
                echo "<a href='leapyearform.php'>Please enter a valid year</a>";
            }
            function is_leapyear($year)
            {
                if ($year % 4 != 0) {
                    return false;
                }
                if ($year % 100 == 0 && $year % 400 != 0) {
                    return false;
                }
                return true;
            }
        ?>
    </body>
</html>