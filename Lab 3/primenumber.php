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
            $num = 5;
            if (isset($_GET["num"]) and $_GET["num"] > 0) {
                $num = $_GET["num"];
                if (is_prime($num)) {
                    echo "True";
                } else {
                    echo "False";
                }
            }
            else {
                echo "<a href='primenumberform.php'>Please enter a valid number</a>";
            }
            function is_prime($num)
            {
                if ($num == 1) {
                    return true;
                }

                for ($i = 2; $i < $num; $i++) {
                    if ($num % $i == 0) {
                        return false;
                    }
                }
                return true;
            }
        ?>
    </body>
</html>
