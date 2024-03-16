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
        <h1>Add VIP Member</h1>
        <form action="member_add.php" method="post">
            <fieldset>
                <legend><b>Add a new member</b></legend>
                <p>First Name
                    <input type="text" id="fname" name="fname" required>
                </p>

                <p>Last Name
                    <input type="text" id="lname" name="lname" required>
                </p>

                <p>Gender
                    <input type="text" id="gender" name="gender" required>
                </p>

                <p>Email
                    <input type="email" id="email" name="email" required>
                </p>

                <p>Phone
                    <input type="text" id="phone" name="phone" required>
                </p>

                <input type="submit" value="Add Member">
                <input type="reset">
            </fieldset>
        </form>
    </body>
</html>