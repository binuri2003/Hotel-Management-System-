<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Block non-admins
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    echo "Access denied. Admins only.";
    exit;
}

echo "Welcome ADMIN!<br>";
echo "User ID: " . $_SESSION['user_id'];
?>