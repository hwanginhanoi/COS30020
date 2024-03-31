<?php
    include_once("connect.php");
    $err_msg = "";
    session_start();

    // Check if there is session variable
    if (!isset($_SESSION["friend_id"]) || $_SESSION["friend_email"] || $_SESSION["profile_name"] !== true) {
        $friend_id = $_SESSION["friend_id"];
        $profile_name = $_SESSION["profile_name"];

        // Check if there is GET variable
        if (isset($_GET["unfriend_id"])) {
            $unfriend_id = $_GET["unfriend_id"];
            try {
                // Make a transaction to unfriend, ensure that all data is inserted and modified using SQL transaction
                @mysqli_query($conn, "START TRANSACTION;");
                $delete_friend_query = "DELETE FROM myfriends 
                                        WHERE (friend_id1 = $friend_id AND friend_id2 = $unfriend_id)
                                        OR (friend_id2 = $friend_id AND friend_id1 = $unfriend_id);";
                @mysqli_query($conn, $delete_friend_query);
                $reduce_num_of_friends_1 = "UPDATE friends 
                                        SET num_of_friends = num_of_friends - 1
                                        WHERE friend_id = $friend_id
                                        AND num_of_friends > 0;";
                @mysqli_query($conn, $reduce_num_of_friends_1);
                $reduce_num_of_friends_2 = "UPDATE friends 
                                        SET num_of_friends = num_of_friends - 1
                                        WHERE friend_id = $unfriend_id
                                        AND num_of_friends > 0;";
                @mysqli_query($conn, $reduce_num_of_friends_2);
                @mysqli_query($conn, "COMMIT;");
            } catch (Throwable $e) {
                mysqli_rollback($conn);
                $err_msg .= $e->getMessage();
            }

        }

        // Number of friend query
        $num_of_friends_query = "SELECT COUNT(*) AS num_of_friends
                                FROM (
                                    SELECT friends.friend_id, friends.profile_name
                                    FROM friends
                                    INNER JOIN myfriends
                                    ON (myfriends.friend_id1 = $friend_id AND myfriends.friend_id2 = friends.friend_id)
                                    OR (myfriends.friend_id2 = $friend_id AND myfriends.friend_id1 = friends.friend_id)
                                ) AS subquery;";

        $num_of_friends_result = @mysqli_query($conn, $num_of_friends_query);
        $rows = mysqli_fetch_assoc($num_of_friends_result);
        $num_of_friends = (int)$rows['num_of_friends'];
        $limit = 5;

        // Get maximum number of page
        $number_of_page = ceil($num_of_friends / $limit);

        // Sanitize the GET input in URL
        if (!isset ($_GET['page']) || $_GET['page'] < 1) {
            $page = 1;
        } elseif ($_GET['page'] > $number_of_page) {
            $page = $number_of_page;
        } else {
            $page = $_GET['page'];
        }

        // Calculate offset for SQL query
        $offset = ($page * $limit) - $limit;

        // SQL query for friend
        $friends_query = "SELECT friends.friend_id, friends.profile_name
                    FROM friends
                    INNER JOIN myfriends
                    ON myfriends.friend_id1 = $friend_id AND myfriends.friend_id2 = friends.friend_id
                    OR myfriends.friend_id2 = $friend_id AND myfriends.friend_id1 = friends.friend_id
                    ORDER BY friends.profile_name
                    LIMIT $limit
                    OFFSET $offset";
        $result = @mysqli_query($conn, $friends_query);
    } else {
        header("location: login.php");
    }
    @mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Friend List Page</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <body class="bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-md px-4 lg:px-12 my-20">
            <div class="bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <h1 class="text-2xl font-bold leading-tight tracking-tight text-white">
                            <?php echo $profile_name ?>'s Friend List Page
                        </h1>
                        <p class="mt-2">Total number of friends is  <?php echo $num_of_friends ?></p>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a href="friendadd.php"
                           class="text-white flex items-center justify-center focus:ring-4 font-medium rounded-lg text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                            </svg>
                            Add friend
                        </a>
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <a href="logout.php" id="filterDropdownButton"
                               class="btn w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-gray-700 bg-gray-800 text-gray-400 border-gray-600 hover:text-white hover:bg-gray-700">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-400">
                        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Profile name</th>
                            <th scope="col" class="px-4 py-3">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                        <tr class="border-b border-gray-700">
                                            <th scope="row" class="px-4 py-3 font-medium whitespace-nowrap text-white">' . $row["profile_name"] . '</th>
                                            <th class="px-4 py-3">
                                                <a href="friendlist.php?unfriend_id=' . $row["friend_id"] . '">Unfriend</a>
                                            </th>
                                        </tr>';
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                     aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Showing
                <span class="font-semibold"><?php echo ($offset + 1) . "-" . min($offset + $limit, $num_of_friends) ?></span>
                    of
                    <span class="font-semibold "><?php echo($num_of_friends) ?></span>
                </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <?php if ($page > 1): ?>
                            <li>
                                <a href="friendlist.php?page=<?php echo $page - 1; ?>"
                                   class="flex items-center justify-center h-full py-1.5 px-3 ml-0 rounded-l-lg border bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </li>
                        <?php else: ?>
                            <li>
                                <div class="flex items-center justify-center h-full py-1.5 px-3 ml-0 rounded-l-lg border bg-gray-900 border-gray-700 text-gray-400">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </li>

                        <?php endif ?>
                        <?php if ($page < $number_of_page): ?>
                            <li>
                                <a href="friendlist.php?page=<?php echo $page + 1; ?>"
                                   class="flex items-center justify-center h-full py-1.5 px-3 leading-tight rounded-r-lg border bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </li>
                        <?php else: ?>
                            <li>
                                <div class="flex items-center justify-center h-full py-1.5 px-3 leading-tight rounded-r-lg border bg-gray-900 border-gray-700 text-gray-400">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </li>
                        <?php endif ?>
                    </ul>
                </nav>
            </div>
        </div>
    </body>
</html>