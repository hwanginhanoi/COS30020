<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Your Name" />
        <title>TITLE</title>
    </head>
    <body>
        <h1>Web Programming - Lab 4</h1>
        <?php
            if (isset ($_POST["var"])) {
                $str = $_POST["var"];
                $ogstr = strtolower($str);
                $revstr = strrev($ogstr);
                if (strcmp($ogstr, $revstr) === 0) {
                    echo "<p style='color: green'>The text you entered <b>'$str'</b> is a perfect palindrome!</p>";
                }
                else {
                    echo "<p style='color: red'>The text you entered <b>'$str'</b> is not a perfect palindrome!</p>";
                }
            }
        ?>
    </body>
</html>