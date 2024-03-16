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
        <h1>Lab04 Extra Challenge - Standard Palindrome</h1>
        <form action ="standardpalindromeself.php" method ="post" >
            <label for="var">String</label>
            <input type="text" id="var" name="var" required>
            <button type="submit">Check for Standard Palindrome</button>
        </form>
        <?php
            if (isset ($_POST["var"]) && !empty($_POST["var"])) {
                $str = $_POST["var"];

                $pattern = '/^[\D\s]*$/';
                $punctuation = array('.', ',', '!', '?', ';', ':', '-', '_', '"', "'", '(', ')', '[', ']', '{', '}', ' ', '<', '>');
                $converted_str = str_replace($punctuation, '', $str);

                $ogstr = strtolower($converted_str);

                $revstr = strrev($ogstr);
                if (strcmp($ogstr, $revstr) === 0) {
                    echo "<p style='color: green'>The text you entered <b>'$str'</b> is a standard palindrome!</p>";
                }
                else {
                    echo "<p style='color: red'>The text you entered <b>'$str'</b> is not a standard palindrome!</p>";
                }
            }
            else {
                echo "Please input a value";
            }
        ?>
    </body>
</html>