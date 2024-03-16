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
        <?php
            require_once ("settings.php");
            $conn = mysqli_connect($host, $user, $pswd, $dbnm);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $query = "SELECT member_id, fname, lname FROM vipmembers";
            $result = mysqli_query($conn, $query);

            if ($result->num_rows > 0) {
                echo "<table>
                <tr>
                    <th>Member ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <td>" . $row["member_id"] . "</td>
                    <td>" . $row["fname"] . "</td>
                    <td>" . $row["lname"] . "</td>
                </tr>";
                }

                echo "</table>";
            } else {
                echo "No members found";
            }

            mysqli_close($conn);
        ?>
    </body>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</html>