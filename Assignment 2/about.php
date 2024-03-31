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
            <ul class="list-disc ml-5 text-white">
                <li>PHP version installed in Mercury is <b><?php echo phpversion(); ?></b></li>
                <li>All task attempted and completed.</li>
                <li>During the creation of the website, I implemented advanced searching filter and styled the website
                    with better UI using Tailwind. I also implement proper pagination with full feature of pagination. I
                    only allow access with session vairable.
                </li>
                <li>I find it hard with counting mutual friend with good algorithm. My solution has O(n+m) in best case scenario and O(n*m) in worst case</li>
                <li>I want to improve database using TRIGGER on insert, update and delete</li>
                <li>Discussion point: I understand the lecture clearly without any question, so there is no discussion
                    about that.
                </li>
                <li><img class="abt-img" src="okokok.png"/></li>

            </ul>

            <a href="friendlist.php"
               class="block mt-4 transition ease-in-out delay-150 bg-blue-600 hover:-translate-y-1 hover:scale-110 hover:bg-blue-700 duration-300 text-white px-4 py-2 rounded-md text-center mb-2">
                Friend list</a>
            <a href="friendadd.php"
               class="block transition ease-in-out delay-150 bg-blue-600 hover:-translate-y-1 hover:scale-110 hover:bg-blue-700 duration-300 text-white px-4 py-2 rounded-md text-center mb-2">
                Add friend</a>
            <a href="index.php"
               class="block transition ease-in-out delay-150 bg-blue-600 hover:-translate-y-1 hover:scale-110 hover:bg-blue-700 duration-300 text-white px-4 py-2 rounded-md text-center">
                Index</a>
        </div>
    </body>
</html>
