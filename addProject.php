<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

header("Content-Type: application/json");

include "db.php";

// ✅ ✅ TRÈS IMPORTANT
$data = json_decode(file_get_contents("php://input"));

if (!$data || !isset($data->name) || !isset($data->user_id)) {
    echo json_encode(["error" => "Données manquantes"]);
    exit;
}

$name = $data->name;
$user_id = $data->user_id;

// ✅ INSERT
$sql = "INSERT INTO projects (name, user_id) VALUES ('$name','$user_id')";

if ($conn->query($sql)) {
    echo json_encode([
        "id" => $conn->insert_id,
        "name" => $name
    ]);
} else {
    echo json_encode(["error" => "Erreur SQL"]);
}
?>