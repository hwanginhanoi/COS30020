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
            $var = 227;
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $var = $_GET["number"];
            }

            if (is_numeric($var)) {
                $round_var = round($var);
                echo ($round_var % 2 == 0) ? "The variable $round_var <b>contains an even number</b>." : "The variable $round_var <b>contains an odd number</b>.";
            }
            else {
                echo "The variable $var <b>is not a number</b>.";
            }
        ?>
    </body>
</html>
