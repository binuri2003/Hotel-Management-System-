<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../backend/login.php");
    exit();
}
include "../db/connection.php";


$payments = mysqli_query($conn, "
    SELECT PaymentID, Customer_UserID, FinalPrice, PaymentDate, PaymentMethod
    FROM payment
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Management</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="page-container">

    <div class="section">
        <h2>Payment Management</h2>
    </div>

    <div class="section table-container">
        <table>
            <tr>
                <th>Payment ID</th>
                <th>Customer ID</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Payment Method</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($payments)) { ?>
            <tr>
                <td><?php echo $row['PaymentID']; ?></td>
                <td><?php echo $row['Customer_UserID']; ?></td>
                <td><?php echo $row['FinalPrice']; ?></td>
                <td><?php echo $row['PaymentDate']; ?></td>
                <td><?php echo $row['PaymentMethod']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

</body>
</html>
