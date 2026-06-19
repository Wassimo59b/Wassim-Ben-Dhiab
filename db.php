<?php
$host = getenv("railway");
$user = getenv("root");
$password = getenv("DNrSuFsqEryhWioWJADhOazXYSTbbSvv");
$database = getenv("railway");
$port = getenv("3306");

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
