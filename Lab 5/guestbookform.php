<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Your Name" />
        <title>TITLE</title>
    </head>
    <body>
        <h1>Lab05 Task 2 - Guestbook</h1>
        <form action="guestbooksave.php" method="post">
            <fieldset>
                <legend><b>Enter your details to sign our guest book</b></legend>
                <p>First Name
                    <input name="firstname"/>
                </p>
                <p>Last Name
                    <input name="lastname"/>
                </p>
                <input type="submit" value="Submit"/>
            </fieldset>
        </form>
        <br>
        <a href="guestbookshow.php">Show Guest Book</a>
    </body>
</html>