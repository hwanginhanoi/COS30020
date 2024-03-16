<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="description" content="Web application development"/>
        <meta name="keywords" content="PHP"/>
        <meta name="author" content="Luu Tuan Hoang"/>
        <title>TITLE</title>
    </head>
    <body>
        <h1>Web Programming - Lab06</h1>
        <?php // read the comments for hints on how to answer each item
            if (isset($_POST["name"]) and isset($_POST["email"])) { // check if both form data exists
                $regexp = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
                $name = $_POST["name"]; // obtain the form item data
                $email = $_POST["email"]; // obtain the form quantity data
                if (preg_match($regexp, $email)) {
                    echo "<p>Email address is valid.</p>";
                    unmask(0007);
                    $filename = "guestbook.txt"; // assumes php file is inside lab06
                    $alldata = array(); // create an empty array
                    if (file_exists($filename)) { // check if file exists for reading
                        $itemdata = []; // create an empty array
                        $handle = fopen($filename, "r"); // open the file in read mode
                        while (!feof($handle)) { // loop while not end of file
                            $onedata = fgets($handle); // read a line from the text file
                            if ($onedata != "") { // ignore blank lines
                                $data = explode(",", $onedata); // explode string to array
                                $alldata [] = $data; // create an array element
                                $itemdata[] = $data [0]; // create a string element
                            }
                        }
                        fclose($handle); // close the text file
                        $newdata = !(in_array($name, $itemdata)); // check if item exists in array
                    } else {
                        $newdata = true; // file does not exist, thus it must be a new data
                    }
                    if ($newdata) {
                        $handle = fopen($filename, "a"); // open the file in append mode
                        $data = $name . "," . $email . "\n"; // concatenate item and qty delimited // by comma
                        fputs($handle, $data); // write string to text file
                        fclose($handle); // close the text file
                        $alldata [] = array($name, $email); // add data to array
                        echo "<p style='color: green'>Thank you for signing our guest book:</p>";
                        echo "<p><b>Name</b>: $name<br><b>E-mail</b>: $email</p>";
                    } else {
                        echo "<p style='color:red'>You have already signed our guest book!</p>";
                    }
                } else {
                    echo "<p style='color: red'><b>Email address is not valid.</b></p>";
                }
            } else { // no input
                echo "<p>Please enter item and quantity in the input form.</p>";
            }
            echo '<p><a href="guestbookform.php">Add Another Visitor</a><br><a href="guestbookshow.php">View Guest Book</a></p>';
        ?>
    </body>
</html>
