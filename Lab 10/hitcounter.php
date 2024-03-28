<?php
    class HitCounter
    {
        private $dbConnection;

        function __construct($dbHost, $dbUsername, $dbPassword, $dbName)
        {
            // Establish connection to the database
            $this->dbConnection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
            if ($this->dbConnection->connect_error) {
                echo "<p style='color: red;'>Unable to connect to the database server.</p>"
                    . "<p>Error code " . $this->dbConnection->connect_errno
                    . ": " . $this->dbConnection->connect_error . "</p>";
                die();
            }
            // Check if the table exists
            $tableName = "hitcounter";
            $sql = "SELECT * FROM $tableName;";
            $this->dbConnection->query($sql)
            or die("<p style='color: red;'>Unable to execute the query.</p>"
                . "<p>Error code " . $this->dbConnection->errno
                . ": " . $this->dbConnection->error . "</p>");
        }

        function getHits()
        {
            $sql = "SELECT * FROM hitcounter;";
            $result = $this->dbConnection->query($sql)
            or die("<p style='color: red;'>Unable to execute the query.</p>"
                . "<p>Error code " . $this->dbConnection->errno
                . ": " . $this->dbConnection->error . "</p>");
            $row = $result->fetch_assoc();
            return $row["hits"];
        }

        function setHits($hit)
        {
            $sql = "UPDATE hitcounter SET hits = $hit;";
            $result = $this->dbConnection->query($sql);
            if (!$result) {
                echo "<p style='color: red;'>Unable to execute the query.</p>"
                    . "<p>Error code " . $this->dbConnection->errno
                    . ": " . $this->dbConnection->error . "</p>";
                die();
            } else {
                echo "<p style='color: green;'>Hits updated successfully.</p>";
            }
        }

        function closeConnection()
        {
            $this->dbConnection->close();
        }

        function startOver()
        {
            $sql = "UPDATE hitcounter SET hits = 0;";
            $result = $this->dbConnection->query($sql);
            if (!$result) {
                echo "<p style='color: red;'>Unable to execute the query.</p>"
                    . "<p>Error code " . $this->dbConnection->errno
                    . ": " . $this->dbConnection->error . "</p>";
                die();
            } else {
                echo "<p style='color: green;'>Hits reset successfully.</p>";
            }
        }
    }
