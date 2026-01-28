<?php
include "db.php";

$room_id = $_POST['room_id'];
$food_id = $_POST['food_id'];
$quantity = $_POST['quantity'];
$total = $_POST['total_price'];

$sql = "INSERT INTO orders (room_id, food_id, quantity, total_price)
        VALUES ('$room_id','$food_id','$quantity','$total')";

if (mysqli_query($conn, $sql)) {
    echo "<h2> Bill Saved Successfully</h2>";
    echo "<p>Room ID: $room_id</p>";
    echo "<p>Food ID: $food_id</p>";
    echo "<p>Quantity: $quantity</p>";
    echo "<p>Total: Rs. $total</p>";
    echo "<a href='order.html'>New Order</a>";
} else {
    echo " Error saving bill";
}
?>