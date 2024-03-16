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
        <table>
            <tr>
                <th>Car ID</th>
                <th>Make</th>
                <th>Model</th>
                <th>Price</th>
            </tr>
            <?php
                require_once("settings.php");

                $conn = @mysqli_connect($host, $user, $pswd, $dbnm);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $query = "SELECT car_id, make, model, price FROM cars";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result)){
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["car_id"] . "</td>";
                        echo "<td>" . $row["make"] . "</td>";
                        echo "<td>" . $row["model"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "No results";
                }

                mysqli_close($conn);
            ?>
        </table>
    </body>

    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</html>