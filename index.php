<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

$secret_key = "your_secret_key"; // Change this to a secure key
$users = [
    "admin" => "password123",
    "user" => "userpass"
];

// Read input JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['username']) || !isset($data['password'])) {
    echo json_encode(["error" => "Missing credentials"]);
    exit;
}

$username = $data['username'];
$password = $
