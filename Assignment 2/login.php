<?php
    include_once("connect.php");
    include("validation.php");
    session_start();
    $errors = [];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Validate email input
            if (!validate_email($email)) {
                $errors['email'] = "Invalid email format";
            }

            // Validate password input
            if (!validate_password($password)) {
                $errors['password'] = "Invalid password format";
            }

            // Check if email is registered
            if (!validate_email_in_db($email, $conn)) {
                $errors['email'] = "Email is not registered";
            }

            // If no error than start querying into database to check if the credential matches
            if (!($errors)) {
                $get_user = @mysqli_query($conn, "SELECT friend_id, friend_email, profile_name FROM friends WHERE friend_email = '$email' AND password = '$password';");
                if ($get_user) {
                    // If true than start session variable
                    if (mysqli_num_rows($get_user)) {
                        $user = mysqli_fetch_assoc($get_user);
                        $_SESSION["friend_id"] = $user["friend_id"];
                        $_SESSION["friend_email"] = $user["friend_email"];
                        $_SESSION["profile_name"] = $user["profile_name"];
                        header("location: friendlist.php");
                    } else {
                        $errors['password'] = "Invalid password";
                    }
                } else {
                }
            }
        } else {
            $errors['missing'] = "Missing required fields";
        }
    }
    @mysqli_close($conn);
?>

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
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,300,0,-25"/>
    </head>
    <body class="flex items-center justify-center h-screen bg-gray-900 px-6 py-8">
        <div class="max-w-lg w-full bg-white  rounded-lg shadow-md bg-gray-800 border-gray-700 border p-6 space-y-4 md:space-y-6 sm:p-8">
            <form class="space-y-4 md:space-y-6" action="login.php" method="post">
                <h1 class="text-2xl font-bold leading-tight tracking-tight text-white mb-4">
                    My Friend System Login Page</h1>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 text-white">Your
                        email</label>
                    <input type="text" name="email" id="email"
                           class="border sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="name@company.com"
                           value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>">
                    <?php if (isset($errors['email'])): ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors['email']; ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="password"
                           class="block mb-2 text-sm font-medium text-gray-900 text-white">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                           class="border sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500">
                    <?php if (isset($errors['password'])): ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors['password']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="grid grid-cols-2 gap-24">
                    <div class="text-sm">
                        <button type="reset" class="flex text-gray-300 items-center"><span
                                    class="material-symbols-outlined">refresh</span>Reset
                        </button>
                    </div>
                    <div class="text-sm flex text-gray-300 items-center">
                       <a href="index.php">Back to homepage</a>
                    </div>
                </div>
                <button type="submit"
                        class="w-full text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 dark:focus:ring-blue-800">
                    Sign in
                </button>
                <?php if (isset($errors['missing'])): ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo $errors['missing']; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </body>
</html>
