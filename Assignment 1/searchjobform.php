<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Search Job Vacancy</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold mb-4">Job Vacancy Searching</h1>
            <form action="searchjobprocess.php" method="get">
                <div class="flex mb-4">
                    <label for="search" class="self-center">Job title:</label>
                    <input type="text" id="search" name="search"
                           class="w-3/5 border border-gray-300 rounded-md py-2 px-3 ml-2 mr-2 focus:outline-none focus:border-blue-500">
                    <button type="submit" class="w-1/5 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Submit
                    </button>
                </div>
                <div class="mb-4">
                    <label class="block">Position:</label>
                    <input type="radio" id="full_time" name="position" value="Full Time" class="mr-1">
                    <label for="full_time" class="mr-4">Full Time</label>
                    <input type="radio" id="part_time" name="position" value="Part Time" class="mr-1">
                    <label for="part_time">Part Time</label>
                </div>
                <div class="mb-4">
                    <label class="block">Contract:</label>
                    <input type="radio" id="on_going" name="contract" value="On-going" class="mr-1">
                    <label for="on_going" class="mr-4">On-going</label>
                    <input type="radio" id="fixed_term" name="contract" value="Fixed term" class="mr-1">
                    <label for="fixed_term">Fixed term</label>
                </div>
                <div class="mb-4">
                    <label class="block">Accept Application by:</label>
                    <input type="checkbox" id="post" name="application_by[]" value="Post" class="mr-1">
                    <label for="post" class="mr-4">Post</label>
                    <input type="checkbox" id="email" name="application_by[]" value="Email" class="mr-1">
                    <label for="email">Email</label>
                </div>
                <div class="mb-4">
                    <label for="location" class="block">Location:</label>
                    <select id="location" name="location"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                        <option value="" disabled selected>---</option>
                        <option value="ACT">ACT</option>
                        <option value="NSW">NSW</option>
                        <option value="NT">NT</option>
                        <option value="QLD">QLD</option>
                        <option value="SA">SA</option>
                        <option value="TAS">TAS</option>
                        <option value="VIC">VIC</option>
                        <option value="WA">WA</option>
                    </select>
                </div>
            </form>
            <a href="index.php" class="block mt-4 text-blue-500">Return to Home Page</a>
        </div>
    </body>
</html>
