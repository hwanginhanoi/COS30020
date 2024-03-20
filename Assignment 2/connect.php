<?php
    require("settings.php");
    $conn = @mysqli_connect($host, $user, $pswd, $dbnm);
    $query1 = "CREATE TABLE IF NOT EXISTS `friends` (
                    friend_id INT NOT NULL AUTO_INCREMENT,
                    friend_email VARCHAR(50) NOT NULL,
                    password VARCHAR(20) NOT NULL,
                    profile_name VARCHAR(30) NOT NULL,
                    date_started DATE NOT NULL,
                    num_of_friends INT UNSIGNED DEFAULT 0,
                    PRIMARY KEY (friend_id),
                    UNIQUE KEY (friend_email)
               ) engine=InnoDB";

    $query2 = "CREATE TABLE IF NOT EXISTS `myfriends` (
                    friend_id1 INT NOT NULL,
                    friend_id2 INT NOT NULL,
                    PRIMARY KEY (friend_id1, friend_id2),
                    FOREIGN KEY (friend_id1) REFERENCES friends(friend_id),
                    FOREIGN KEY (friend_id2) REFERENCES friends(friend_id),
                    CONSTRAINT `check_duplication` CHECK (friend_id1 != friend_id2)
               ) engine=InnoDB";

    mysqli_query($conn, $query1);
    mysqli_query($conn, $query2);
