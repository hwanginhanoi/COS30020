<?php
    // Clear session variable and close session
    session_start();
    session_unset();
    session_destroy();
    header("location:login.php");
