<?php
session_start();
include 'config.php';

/* -------- ADMIN PROTECTION -------- */
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    die("Access denied. Admins only.");
}

/* -------- FETCH PAYMENTS -------- */
$sql = "
SELECT 
    p.PaymentID,
    p.FinalPrice,
    p.PaymentDate,
    p.PaymentMethod,
    u.FirstName,
    u.LastName,
    u.Email
FROM payment p
JOIN user u ON p.Customer_UserID = u.UserID
ORDER BY p.PaymentDate DESC
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Payments</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #333; color: white; }
    </style>
</head>
<body>

<h2>All Customer Payments</h2>

<table>
    <tr>
        <th>Payment ID</th>
        <th>Customer Name</th>
        <th>Email</th>
        <th>Final Price</th>
        <th>Payment Date</th>
        <th>Method</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['PaymentID'] ?></td>
        <td><?= $row['FirstName'] . " " . $row['LastName'] ?></td>
        <td><?= $row['Email'] ?></td>
        <td><?= $row['FinalPrice'] ?></td>
        <td><?= $row['PaymentDate'] ?></td>
        <td><?= $row['PaymentMethod'] ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
