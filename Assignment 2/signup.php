<?php
    include_once("connect.php");
    include("validation.php");
    session_start();
    $errors = [];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!empty($_POST['email']) &&
            !empty($_POST['name']) &&
            !empty($_POST['password']) &&
            !empty($_POST['confirm_password'])) {
            $email = trim($_POST['email']);
            $name = trim($_POST['name']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            if (!validate_email($email)) {
                $errors['email'] = "Invalid email format";
            }

            if (!validate_profile_name($name)) {
                $errors['name'] = "Invalid profile name format";
            }

            if (!validate_password($password)) {
                $errors['password'] = "Invalid password format";
            }

            if ($password != $confirm_password) {
                $errors['confirm_password'] = "Passwords do not match";
            }

            if (validate_email_in_db($email, $conn)) {
                $errors['email'] = "Email already registered";
            }

            if (!($errors)) {
                if (@mysqli_query($conn, "INSERT INTO friends (friend_email, profile_name, password, date_started) VALUES ('$email', '$name', '$password', CURRENT_TIMESTAMP())")) {
                    $get_user = @mysqli_query($conn, "SELECT friend_id, friend_email, profile_name FROM friends WHERE friend_email = '$email' AND password = '$password';");
                    if ($get_user) {
                        $user = mysqli_fetch_assoc($get_user);
                        $_SESSION["friend_id"] = $user["friend_id"];
                        $_SESSION["friend_email"] = $user["friend_email"];
                        $_SESSION["profile_name"] = $user["profile_name"];
                        header("location: friendadd.php");
                    } else {
                        $err_msg = $err_msg . "
                                Register failed, try again later. <br/>
                                Error: " . htmlspecialchars(addslashes($conn->error)) . " <br/>
                            ";
                    }
                } else {
                    echo $errors['insert'] = ("Error: " . $sql . "<br>" . $conn->error);
                }
            }
        } else {
            $errors['missing'] = "Missing required fields";
        }
    }
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
            <form class="space-y-4 md:space-y-6" method="post" action="signup.php">
                <h1 class="text-2xl font-bold leading-tight tracking-tight text-white mb-4">
                    My Friend System Registration Page</h1>
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
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 text-white">Profile
                        name</label>
                    <input type="text" name="name" id="name"
                           class="border sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Luu Tuan Hoang"
                           value="<?php if (isset($_POST["name"])) echo $_POST["name"]; ?>">
                    <?php if (isset($errors['name'])): ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors['name']; ?></p>
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
                <div>
                    <label for="confirm_password"
                           class="block mb-2 text-sm font-medium text-gray-900 text-white">Confirm password</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="••••••••"
                           class="border sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500">
                    <?php if (isset($errors['confirm_password'])): ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors['confirm_password']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="text-sm flex items-center">
                    <button type="reset" class="text-gray-300"><span class="material-symbols-outlined">refresh</span>Reset
                    </button>
                </div>
                <button type="submit"
                        class="w-full text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 dark:focus:ring-blue-800">
                    Register
                </button>
                <?php if (isset($errors['missing'])): ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo $errors['missing']; ?></p>
                <?php endif; ?>
                <?php if (isset($errors['insert'])): ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo $errors['insert']; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </body>
</html>