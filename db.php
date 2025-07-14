<?php
$servername = "localhost"; // Adjust if using a remote server
$username = "ugrj543f7lree";
$password = "cgmq43woifko";
$dbname = "dbgypjw8fppgfw";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
