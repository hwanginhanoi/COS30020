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
        <p>Enter a number between 1 and 100, then press the Guess button.</p>
        <form method="post">
            <p>
                <input name="number">
                <input type="submit">
            </p>
        </form>
        <?php
            session_start();

            if (!isset($_SESSION["answer"])) {
                $_SESSION["answer"] = rand(1, 100);
                $_SESSION["count"] = 0;
            }

            if (isset($_POST["number"])) {
                if (is_numeric($_POST["number"]) && !empty($_POST["number"]) && $_POST["number"] >= 1 && $_POST["number"] <= 100) {
                    $number = $_POST["number"];
                    $_SESSION["count"]++;

                    if ($number < $_SESSION["answer"]) {
                        echo "<p>Guess higher!</p>";
                    } else if ($number > $_SESSION["answer"]) {
                        echo "<p>Guess lower!</p>";
                    } else {
                        echo "<p style='color:green'>Congratulations! You guessed the hidden numer.</p>";
                    }
                } else {
                    echo "<p style='color:red'>You must enter a number between 1 and 100!</p>";
                }
            } else {
                echo "<p>Start guessing.</p>";
            }
        ?>
        <p>Number of guesses: <?php echo $_SESSION["count"]; ?>.</p>
        <p><a href="giveup.php">Give Up</a></p>
        <p><a href="startover.php">Start Over</a></p>

    </body>
</html>