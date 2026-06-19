<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

header("Content-Type: application/json");

include "db.php";

// ✅ Lire les données
$data = json_decode(file_get_contents("php://input"));

// ✅ Vérifier si data existe
if (!$data || !isset($data->username) || !isset($data->password)) {
    echo json_encode(["error" => "No data received"]);
    exit;
}

$username = $data->username;
$password = $data->password;

// ✅ Chercher utilisateur
$result = $conn->query("SELECT * FROM users WHERE username='$username'");
$user = $result->fetch_assoc();

// ✅ Vérifier mot de passe
if ($user && password_verify($password, $user['password'])) {
    echo json_encode([
        "id" => $user['id'],
        "username" => $user['username'],
        "role" => $user['role']
    ]);
} else {
    echo json_encode(["error" => "Login incorrect"]);
}
?>