<?php
    // Validate email input using regex
    function validate_email($email)
    {
        if (!preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email)) {
            return false;
        }
        else {
            return true;
        }
    }

    // Validate profile name input using regex
    function validate_profile_name($name)
    {
        if (!preg_match("/^[A-Za-z]+$/", $name)) {
            return false;
        }
        else {
            return true;
        }
    }

    // Validate password input using regex
    function validate_password($password)
    {
        if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
            return false;
        } else {
            return true;
        }
    }


    // Check if the email is existed in database
    function validate_email_in_db($email, $conn)
    {
        if(mysqli_num_rows($conn->query("SELECT friend_email FROM friends WHERE friend_email = '$email'")) > 0) {
            return true;
        }
        else {
            return false;
        }
    }