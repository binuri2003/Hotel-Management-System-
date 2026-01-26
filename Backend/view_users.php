<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

// Admin check
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM user");

echo "<h2>All Users</h2>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "ID: {$row['UserID']} | ";
    echo "Name: {$row['FirstName']} {$row['LastName']} | ";
    echo "Username: {$row['Username']}<br>";
}
?>
