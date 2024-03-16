<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Post Job Vacancy</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 py-10">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold mb-2">Post Job Vacancy</h1>
            <p class="mb-2 text-red-600">* All fields are required</p>
            <form action="postjobprocess.php" method="post">
                <div class="mb-4">
                    <label for="position_id" class="block">Position ID:</label>
                    <input type="text" id="position_id" name="position_id"
                           title="Position ID must start with PID followed by 4 digits"
                           class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="title" class="block">Title:</label>
                    <input type="text" id="title" name="title"
                           title="Title can only contain letters, digits, spaces, comma, period, and exclamation point"
                           class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="description" class="block">Description:</label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"></textarea>
                </div>
                <div class="mb-4">
                    <label for="closing_date" class="block">Closing Date:</label>
                    <input type="text" id="closing_date" name="closing_date"
                           value="<?php echo date('d/m/y'); ?>"
                           class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
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
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Submit
                </button>
            </form>

            <a href="index.php" class="block mt-4 text-blue-500">Return to Home Page</a>
        </div>
    </body>
</html>
