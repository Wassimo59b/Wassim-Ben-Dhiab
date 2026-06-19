<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// ✅ Gérer la requête OPTIONS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

include "db.php";

$data = json_decode(file_get_contents("php://input"));

$id = $data->id;
$name = $data->name;

$conn->query("UPDATE projects SET name='$name' WHERE id=$id");

echo json_encode(["message" => "Modifié"]);
?>