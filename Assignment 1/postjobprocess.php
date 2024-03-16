<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Post Job Vacancy</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold mb-4">Job Vacancy Search</h1>
            <?php
                umask(0007);
                $directory = '../../data/jobposts';

                // mkdir if not exist
                if (!file_exists($directory)) {
                    mkdir($directory, 02770, true);
                }

                // I use file_put_contents because it is much more simple, which is equivalent to fopen, fread/fputs and fclose
                $path = '../../data/jobposts/jobs.txt';
                if (!file_exists($path)) {
                    file_put_contents($path, '');
                }

                // Validate input of PID
                function validatePositionID($position_id)
                {
                    return preg_match('/^PID\d{4}$/', $position_id);
                }

                // Validate title
                function validateTitle($title)
                {
                    return preg_match('/^[A-Za-z0-9\s,.!]{1,20}$/', $title);
                }

                // Validate length of description
                function validateDescription($description)
                {
                    return strlen($description) <= 250;
                }

                // Validate closing date
                function validateClosingDate($closing_date)
                {
                    $format = 'd/m/y';
                    $dateTime = DateTime::createFromFormat($format, $closing_date);

                    if ($dateTime && $dateTime->format($format) === $closing_date) {
                        return true;
                    } else {
                        return false;
                    }
                }


                // Check if there is any duplicate PID in the txt file
                function validateDuplicatePositionID($path, $position_id)
                {
                    $data = file_get_contents($path);
                    $lines = explode("\n", $data);
                    foreach ($lines as $line) {
                        $fields = explode("\t", $line);
                        if (isset($fields[0]) && $fields[0] === $position_id) {
                            return true;
                        }
                    }
                    return false;
                }

                // Check if the form variable is set and not empty
                if (isset($_POST['position_id']) && isset($_POST['title']) &&
                    isset($_POST['description']) && isset($_POST['closing_date']) &&
                    isset($_POST['position']) && isset($_POST['contract']) &&
                    isset($_POST['application_by']) && isset($_POST['location']) &&
                    !empty($_POST['position_id']) && !empty($_POST['title']) &&
                    !empty($_POST['description']) && !empty($_POST['closing_date']) &&
                    !empty($_POST['position']) && !empty($_POST['contract']) &&
                    !empty($_POST['application_by']) && !empty($_POST['location'])) {

                    // State for the input validation
                    $input_error = False;

                    // Array that contains error message strings
                    $error_msg = [];

                    $position_id = $_POST['position_id'];
                    if (!validatePositionID($position_id)) {
                        $input_error = True;
                        $error_msg[] = "Position ID is invalid";
                    }

                    $title = $_POST['title'];
                    if (!validateTitle($title)) {
                        $input_error = True;
                        $error_msg[] = "Title is invalid";
                    }

                    $description = $_POST['description'];
                    if (!validateDescription($description)) {
                        $input_error = True;
                        $error_msg[] = "Description is invalid";
                    }

                    $closing_date = $_POST['closing_date'];
                    if (!validateClosingDate($closing_date)) {
                        $input_error = True;
                        $error_msg[] = "Closing date is invalid";
                    }

                    $position = $_POST['position'];
                    $contract = $_POST['contract'];
                    $application_by = $_POST['application_by'];

                    $post_selected = in_array('Post', $_POST['application_by']) ? 'True' : 'False';
                    $email_selected = in_array('Email', $_POST['application_by']) ? 'True' : 'False';

                    $location = $_POST['location'];

                    if (!$input_error) {
                        if (!validateDuplicatePositionID($path, $position_id)) {
                            // Write to the file in APPEND mode
                            $data = "$position_id\t$title\t$description\t$closing_date\t$position\t$contract\t$post_selected\t$email_selected\t$location\n";
                            file_put_contents($path, $data, FILE_APPEND);
                            echo "Job posted!\n";
                            echo '<a href="index.php" class="block mt-4 text-blue-500">Return to Home Page</a>';
                        } else {
                            echo "The ID {$position_id} already exists.\n";
                            echo '<a href="postjobform.php" class="block mt-4 text-blue-500">Submit another job post</a>';
                            echo '<a href="index.php" class="block mt-4 text-blue-500">Return to Home Page</a>';
                        }
                    } else {
                        foreach ($error_msg as $error) {
                            echo '<p class="mb-2">' . $error . '</p>';
                        }
                        echo '<a href="postjobform.php" class="block mt-4 text-blue-500">Submit another job post</a>';
                        echo '<a href="index.php" class="block mt-4 text-blue-500">Return to Home Page</a>';
                    }
                } else {
                    echo '<p>All fields are required</p>';
                    echo '<a href="postjobform.php" class="block mt-4 text-blue-500">Submit another job post</a>';
                    echo '<a href="index.php" class="block mt-4 text-blue-500">Return to Home Page</a>';
                }
            ?>
        </div>
    </body>
</html>


