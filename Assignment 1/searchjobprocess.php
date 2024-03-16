<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Search Job Vacancy Information</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 flex items-center justify-center">
        <div class="max-w-4xl w-full bg-white p-6 rounded-lg shadow-md my-16">
            <h1 class="text-2xl font-semibold mb-2">Job Vacancy Information</h1>
            <?php
                // Validate search by Regex, the same as title validation
                function validateSearch($search)
                {
                    return preg_match('/^[A-Za-z0-9\s,.!]{1,20}$/', $search);
                }

                // Validate closing date by converting to UNIX date format and compare with current date
                function validateBeforeClosingDate($closing_date)
                {
                    $current_date = strtotime(date('Y-m-d'));
                    $date_parts = explode('/', $closing_date);
                    if (count($date_parts) === 3) {
                        $input_date = strtotime('20' . $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0]);

                        if ($input_date === false) {
                            return false;
                        }

                        if ($input_date >= $current_date) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }

                // Sorting function for usort()
                function sortByDate($a, $b) {
                    $dateA = DateTime::createFromFormat('d/m/y', $a[3]);
                    $dateB = DateTime::createFromFormat('d/m/y', $b[3]);

                    if ($dateA == $dateB) {
                        return 0;
                    }

                    return ($dateA > $dateB) ? -1 : 1;
                }

                if (!empty($_GET['search'])) {
                    $search = $_GET['search'];
                    if (validateSearch($search)) {
                        umask(0007);
                        $file = '/jobs.txt';
                        $directory = '../../data/jobposts';
                        $path = $directory . $file;
                        if (file_exists($path)) {
                            $file_content = file_get_contents($path);
                            $lines = explode("\n", $file_content);
                            $matches = [];
                            foreach ($lines as $line) {
                                // Convert to array type
                                $fields = explode("\t", $line);

                                // Convert application_by field to string
                                if (!empty($_GET[('application_by')])) {
                                    $post_selected = in_array('Post', $_GET['application_by']) ? 'True' : 'False';
                                    $email_selected = in_array('Email', $_GET['application_by']) ? 'True' : 'False';
                                }

                                // Find matched result
                                if ((isset($fields[1]) && strpos(strtolower($fields[1]), strtolower($search)) !== false) &&
                                    (empty($_GET['position']) || stripos($fields[4], $_GET['position']) !== false) &&
                                    (empty($_GET['contract']) || $fields[5] === $_GET['contract']) &&
                                    (empty($_GET['location']) || stripos($fields[8], $_GET['location']) !== false) &&
                                    (validateBeforeClosingDate($fields[3]) !== false)
                                ) {
                                    // Add the array that contains information into another array
                                    $matches[] = $fields;
                                }
                            }

                            // If there is matched result, echo the div that shows the information
                            if (!empty($matches)) {
                                // Sort the matches array with sorttByDate function
                                usort($matches, 'sortByDate');
                                echo '<p class="mb-2">Data sorted by most future day, from left to right, from top to bottom</p>';
                                echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
                                foreach ($matches as $match) {
                                    $application_by = [];

                                    if ($match[6] === "True") {
                                        $application_by[] = "Post";
                                    }
                                    if ($match[7] === "True") {
                                        $application_by[] = "Email";
                                    }
                                    $application_by_str = implode(", ", $application_by);
                                    echo '<div class="bg-white rounded-lg shadow-md p-6 mb-4">
                                        <p class="text-xl font-semibold">Job Title: ' . $match[1] . '</p>
                                        <p>Description: ' . $match[2] . '</p>
                                        <p>Closing date: ' . $match[3] . '</p>
                                        <p>Position: ' . $match[4] . ' - ' . $match[5] . '</p>
                                        <p>Application by: ' . $application_by_str . '</p>
                                        <p>Location: ' . $match[8] . '</p>
                                      </div>';
                                }
                                echo '</div>';
                                echo '<a href="searchjobform.php" class="block mt-4 text-blue-500">Search another job vacancy</a>';
                                echo '<a href="index.php" class="block mt-4 text-blue-500">Return to Home Page</a>';
                            } else {
                                echo "<p>No match found</p>";
                                echo '<a href="searchjobform.php" class="block mt-4 text-blue-500">Search another job vacancy</a>';
                                echo '<a href="index.php" class="block mt-4 text-blue-500">Return to Home Page</a>';
                            }
                        } else {
                            echo "Sorry, the file $path does not exist.";
                            echo '<a href="index.php" class="block mt-4 text-blue-500">Return to Home Page</a>';
                        }
                    } else {
                        echo "Invalid search";
                        echo '<a href="searchjobform.php" class="block mt-4 text-blue-500">Search another job vacancy</a>';
                        echo '<a href="index.php" class="block mt-4 text-blue-500">Return to Home Page</a>';
                    }
                } else {
                    echo "Empty search";
                    echo '<a href="searchjobform.php" class="block mt-4 text-blue-500">Search another job vacancy</a>';
                    echo '<a href="index.php" class="block mt-4 text-blue-500">Return to Home Page</a>';
                }
            ?>
        </div>
    </body>
</html>
