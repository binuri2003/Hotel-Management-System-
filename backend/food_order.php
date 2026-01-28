<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please login.");
}

if (isset($_POST['submit_order'])) {

    $roomId = $_POST['room_id'];
    $orderTotal = $_POST['order_total'];
    $orderDateTime = date("Y-m-d H:i:s");

    $sql = "INSERT INTO order (RoomID, OrderDateTime, OrderTotal)
            VALUES ('$roomId', '$orderDateTime', '$orderTotal')";

    if (mysqli_query($conn, $sql)) {
        echo "Food order placed successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!-- TEMP TEST FORM (backend testing only) -->
<form method="post">
    Room ID: <input type="number" name="room_id" required><br><br>
    Order Total: <input type="number" step="0.01" name="order_total" required><br><br>
    <button type="submit" name="submit_order">Place Order</button>
</form>