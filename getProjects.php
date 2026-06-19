<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

header("Content-Type: application/json");

include "db.php";

// ✅ lire JSON
$data = json_decode(file_get_contents("php://input"));

// ✅ sécurité
if (!$data) {
    echo json_encode([]);
    exit;
}

$user_id = isset($data->user_id) ? $data->user_id : null;
$role = isset($data->role) ? $data->role : null;

// ✅ DEBUG TEMPORAIRE (tu peux voir dans Network)
error_log("ROLE: " . $role);

// ✅ ADMIN → tous les projets
if ($role === "admin") {
    $sql = "SELECT * FROM projects";
} else {
    // ✅ USER → ses projets uniquement
    $sql = "SELECT * FROM projects WHERE user_id = $user_id";
}

$result = $conn->query($sql);

$projects = [];

while ($row = $result->fetch_assoc()) {
    $projects[] = $row;
}

echo json_encode($projects);
?>