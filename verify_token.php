<?php
require 'db.php';
require 'vendor/jwt/src/JWT.php';
require 'vendor/jwt/src/Key.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

$jwt_secret = "your_secret_key"; // Keep this secure

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit();
}

$input = json_decode(file_get_contents("php://input"), true);
$token = $input['token'] ?? '';

if (!$token) {
    echo json_encode(["status" => "error", "message" => "Token missing"]);
    exit();
}

try {
    $decoded = JWT::decode($token, new Key($jwt_secret, 'HS256'));

    // Check if token is blacklisted (user logged out)
    if (isTokenBlacklisted($pdo, $token)) {
        echo json_encode(["status" => "error", "message" => "Token is invalid or expired"]);
        exit();
    }

    echo json_encode(["status" => "success", "user_id" => $decoded->sub]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Invalid token"]);
}
?>
