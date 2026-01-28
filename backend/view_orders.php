<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    die("Access denied. Admins only.");
}

$sql = "SELECT * FROM order";
$result = mysqli_query($conn, $sql);
?>

<h2>Food Orders</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Room ID</th>
        <th>Order Date & Time</th>
        <th>Order Total</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['RoomID']; ?></td>
            <td><?php echo $row['OrderDateTime']; ?></td>
            <td><?php echo $row['OrderTotal']; ?></td>
        </tr>
    <?php } ?>
</table>