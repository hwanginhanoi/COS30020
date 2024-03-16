<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="Web Programming :: Lab 2" />
        <meta name="keywords" content="Web,programming" />
        <title>Using variables, arrays and operators</title>
    </head>
    <body>
        <?php
            echo "<p>The Days of the week in English are:<br>";
            $days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            echo implode(", ",$days);

            echo "<p>The Days of the week in French are:<br>";
            $days = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
            echo implode(", ",$days);
        ?>
    </body>
</html>
