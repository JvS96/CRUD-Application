<?php
//Database Connection
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$connection_db = "db_propay";

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $connection_db) or die("Connect failed: %s\n" . $conn->error);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}