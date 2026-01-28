<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../backend/login.php");
    exit();
}

include "../db/connection.php";

$orders = mysqli_query($conn, "
    SELECT RoomID, OrderDateTime, OrderTotal
    FROM `order`
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Food Orders</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="page-container">

    <div class="section">
        <h2>Food Orders</h2>
    </div>

    <div class="section table-container">
        <table>
            <tr>
                <th>Room ID</th>
                <th>Order Date & Time</th>
                <th>Total Amount</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($orders)) { ?>
            <tr>
                <td><?php echo $row['RoomID']; ?></td>
                <td><?php echo $row['OrderDateTime']; ?></td>
                <td><?php echo $row['OrderTotal']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

</body>
</html>
