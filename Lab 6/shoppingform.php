<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Luu Tuan Hoang" />
        <title>TITLE</title>
    </head>
    <body>
        <h1>Web Programming Form – Lab06</h1>
        <form action = "shoppingsave.php" method = "post" >
            <label for="item">Item name</label>
            <input type="text" id="item" name="item" required>
            <label for="qty">Quantity</label>
            <input type="number" id="qty" name="qty" required>
            <button type="submit">Add to cart</button>
        </form>
    </body>
</html>
