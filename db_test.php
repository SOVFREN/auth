<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'db.php'; // Load the database connection

if (isset($pdo)) {
    echo "✅ Database connection successful!";
} else {
    echo "❌ Database connection failed!";
}
?>
