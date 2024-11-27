<?php
$servername = "localhost";
$username = "masterkalkor";
$password = "1234ewq@";
$dbname = "rubnl";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


