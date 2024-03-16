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
        <h2>View Guestbook</h2>
        <hr>
        <?php
            $fileName = "guestbook.txt";
            if (!file_exists($fileName) || filesize($fileName) == 0) {
                echo "<p style='color:red'>No guestbook entries found!</p>";
            } else {
                $fileArr = file($fileName);
                echo "<table>";
                echo "<tr>";
                echo "<th>Number</th>";
                echo "<th>Name</th>";
                echo "<th>Email</th>";
                echo "</tr>";
                for ($i = 0; $i < count($fileArr); $i++) {
                    $lineArr = explode(",", $fileArr[$i]);

                    echo "<tr>";
                    echo "<td><b>" . ($i + 1) . "</b></td>";
                    echo "<td>" . $lineArr[0] . "</td>";
                    echo "<td>" . $lineArr[1] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
        <hr>
        <p><a href="guestbookform.php">Add Another Visitor</a></p>
    </body>
</html>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 2px solid #ddd;
    }

    th, td {
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    .center {
        text-align: center;
    }
</style>