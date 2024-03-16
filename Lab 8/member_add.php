<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <h1>Add VIP Member Result</h1>
                <?php
                    require_once("settings.php");
                    $table = "vipmembers";
                    $conn = @mysqli_connect($host, $user, $pswd, $dbnm);

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $query = "CREATE TABLE IF NOT EXISTS vipmembers (
                            member_id INT AUTO_INCREMENT PRIMARY KEY,
                            fname VARCHAR(40),
                            lname VARCHAR(40),
                            gender VARCHAR(1),
                            email VARCHAR(40),
                            phone VARCHAR(20)
                          )";

                    if (mysqli_query($conn, $query)) {
                        echo '<p style="color:green">Table created successfully</p>';
                    } else {
                        echo '<p style="color:red">Error creating table: '. mysqli_error($conn) . "</p>";
                    }

                    if (!empty($_POST["fname"]) &&
                        !empty($_POST["lname"]) &&
                        !empty($_POST["gender"]) &&
                        !empty($_POST["email"]) &&
                        !empty($_POST["phone"])
                    ) {
                        $regexEmail = "/^[a-zA-Z0-9.]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/";
                        $regexPhone = "/^[0-9]/";
                        if (!preg_match($regexEmail, $_POST["email"])) {
                            echo "<p style='color:red'>Email address is not valid.</p>";
                        } else if (!preg_match($regexPhone, $_POST["phone"])) {
                            echo "<p style='color:red'>Phone number is not valid.</p>";
                        } else {
                            $fname = $_POST["fname"];
                            $lname = $_POST["lname"];
                            $gender = $_POST["gender"];
                            $email = $_POST["email"];
                            $phone = $_POST["phone"];

                            $checkExistingQuery = 'SELECT * FROM vipmembers WHERE fname = "$fname" AND lname = "$lname"';
                            $checkExistingResult = mysqli_query($conn, $checkExistingQuery);

                            if (mysqli_num_rows($checkExistingResult) > 0) {
                                echo '<p style="color:red">A member with the same name already exists.</p>';
                            } else {
                                $query = "INSERT INTO vipmembers (fname, lname, gender, email, phone) VALUES ('$fname', '$lname', '$gender', '$email', '$phone')";
                                if (mysqli_query($conn, $query)) {
                                    echo '<p style="color:green">Data inserted successfully</p>';
                                } else {
                                    echo '<p style="color:red">Error inserting input: ' . mysqli_error($conn) . '</p>';
                                }
                            }

                        }
                    } else {
                        echo '<p style="color:red">All fields are required</p>';
                    }

                    mysqli_close($conn);
                ?>
    </body>
</html>