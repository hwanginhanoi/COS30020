<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Homepage</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <body class="flex items-center justify-center h-screen bg-gray-900 px-6 py-8">
        <div class="max-w-lg w-full bg-white rounded-lg shadow-md bg-gray-800 border-gray-700 border p-6 sm:p-8">
            <h1 class="text-2xl font-bold leading-tight tracking-tight text-white mb-4">
                Job Vacancy Posting System</h1>
            <p class="mb-2">Name: Luu Tuan Hoang</p>
            <p class="mb-2">Student ID: 104180391</p>
            <p class="mb-4">Email: 104180391@student.swin.edu.au</p>

            <p class="mb-4">I declare that this assignment is my individual work. I have not worked collaboratively,
                nor
                have I copied from any other student’s work or from any other source.</p>

            <a href="signup.php"
               class="block transition ease-in-out delay-150 bg-blue-600 hover:-translate-y-1 hover:scale-110 hover:bg-blue-700 duration-300 text-white px-4 py-2 rounded-md text-center mb-2">
                Sign-up</a>
            <a href="login.php"
               class="block transition ease-in-out delay-150 bg-blue-600 hover:-translate-y-1 hover:scale-110 hover:bg-blue-700 duration-300 text-white px-4 py-2 rounded-md text-center mb-2">
                Login</a>
            <a href="about.php"
               class="block transition ease-in-out delay-150 bg-blue-600 hover:-translate-y-1 hover:scale-110 hover:bg-blue-700 duration-300 text-white px-4 py-2 rounded-md text-center">About
                this
                Website</a>
            <?php
                include_once("connect.php");

                $insert_friends_query = " INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends) VALUES 
                                        ('lukasrossander@weather.com', 'astralis', 'gla1ve', '2024-03-01', 7),
                                         ('peterrasmussen@astralis.vn', 'dominance', 'dupreeh', '2024-03-01', 7),
                                         ('emilreif7@denmark.dm', 'complexity', 'magiskb0y', '2024-03-01', 7),
                                         ('xyp9x@dropbox.com', 'clutch', 'xyp9x', '2024-03-01', 7),
                                         ('nicolaireedtz@valve.co', 'deptrai', 'dev1ce', '2024-03-01', 7),
                                         ('dannysorensen@gmail.com', 'vitality', 'z0nic', '2024-03-01', 7),
                                         ('larsrobl@something.com', 'mentality', 'robl', '2024-03-01', 7),
                                         ('kevindebruyne@mancity.com', 'manunited', 'kevindebruyne', '2024-03-01', 7),
                                         ('halland@holland.com', 'erling', 'halland', '2024-03-01', 7),
                                         ('hwanginhanoi@gmail.com', 'hanoi', 'hwanginhanoi', '2024-03-01', 7);";

                $insert_myfriends_query = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES 
                                                                                                    (10, 2),
                                                                                                    (3, 5),
                                                                                                    (2, 3),
                                                                                                    (4, 9),
                                                                                                    (1, 4),
                                                                                                    (8, 4),
                                                                                                    (8, 1),
                                                                                                    (6, 5),
                                                                                                    (3, 6),
                                                                                                    (4, 2),
                                                                                                    (1, 9),
                                                                                                    (3, 9),
                                                                                                    (2, 8),
                                                                                                    (1, 10),
                                                                                                    (4, 3),
                                                                                                    (2, 9),
                                                                                                    (3, 1),
                                                                                                    (1, 8),
                                                                                                    (7, 8),
                                                                                                    (7, 3);";
                $initial_populate_data = "Populated data successfully";

                $result = $conn->query("SELECT COUNT(*) AS count FROM friends;");
                $result = mysqli_fetch_assoc($result);

                // Execute populate  SQL
                if($result["count"] == 0) {
                    if(!$conn->query($insert_friends_query)) {
                        $initial_populate_data = "Populated data failed.";
                    }
                }

                // Execute populate  SQL
                $result = $conn->query("SELECT COUNT(*) AS count FROM myfriends;");
                $result = mysqli_fetch_assoc($result);

                if($result["count"] == 0) {
                    if(!$conn->query($insert_myfriends_query)) {
                        $initial_populate_data = "Populated data failed.";
                    }
                }

                $conn -> close();
                echo '<p class="mt-2">' . $initial_schema . '</p>';
                echo '<p class="mt-2">' . $initial_populate_data . '</p>';
            ?>
        </div>
    </body>
</html>

<?php
    include_once("connect.php");
?>
