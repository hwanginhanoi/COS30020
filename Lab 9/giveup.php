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
        <h1>Guessing Game</h1>
        <p style="color: blue;">The hidden number is:
            <?php
                session_start();
                if (isset($_SESSION["answer"])) {
                    echo $_SESSION["answer"];
                } else {
                    echo "Answer is not generated";
                }
            ?>
        </p>
        <p><a href="startover.php">Start Over</a></p>
    </body>
</html>