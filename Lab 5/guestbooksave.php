<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="description" content="Web application development"/>
        <meta name="keywords" content="PHP"/>
        <meta name="author" content="Your Name"/>
        <title>TITLE</title>
    </head>
    <body>
        <h1>Lab05 Task 2 - Guestbook</h1>
        <?php // read the comments for hints on how to answer each item
            umask(0007);
            $dir = "../../data/lab05";
            if (!file_exists($dir)) {
                mkdir($dir, 02770);
            }

            if (!empty($_POST["firstname"]) and !empty($_POST["lastname"]) ) { // check if both form data exists
                $firstname = $_POST["firstname"]; // obtain the form item data
                $lastname = $_POST["lastname"]; // obtain the form quantity data

                $filename = "$dir/guestbook.txt";
                $handle = fopen($filename, "a"); // open the file in append mode
                $data = $firstname . ", " . $lastname . "\n"; // concatenate item and qty delimited by comma
                fwrite($handle, $data); // write string to text file
                fclose($handle); // close the text file

                echo "<p style='color:green'>Thank you for signing our guest book!</p>";
            } else { // no input
                echo "<p style='color:red'><b>You must enter your first and last name!</b>
                        <br>
                        <b>Use the Browser's 'Go Back' button to return to the Guestbook form.</b></p>";
            }
        ?>
    </body>
</html>