<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../backend/login.php");
    exit();
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="page-container">

    <div class="welcome-text">
        Welcome to Hotel Management Admin Portal
    </div>

    <div class="section">
        <h2>Users</h2>
        <a href="../backend/view_users.php" class="button">Manage Users</a>

    </div>

    <div class="section">
        <h2>Room Reservation</h2>
        <a href="add_room.php" class="button">Add Room</a>

        <a href="cancel_reservation.php" class="button">Manage Reservations</a>
    </div>
    <div class="section">
        <h2>Food Reservation</h2>
<a href="food_orders.php" class="button">Food Orders</a>
 </div>
    <div class="section">
        <h2>Inventory Management</h2>
        <a href="inventory.php" class="button">Manage Inventory</a>
    </div>

    <div class="section">
        <h2>Payment Management</h2>
        <a href="payments.php" class="button">View Payments</a>
    </div>

</div>

</body>

</html>

