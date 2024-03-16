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
        <h1>Web Programming Form - Lab 5</h1>
        <form action="shoppingsave.php" method="post">
            <label for="itemname">Item name</label>
            <input type="text" id="itemname" name="itemname" required>
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" required>
            <button type="submit">Add to cart</button>
        </form>
    </body>
</html>