<?php
include "connection.php";

$searchID = "";
$results = null;

if (isset($_GET['search'])) {
    $searchID = $_GET['userID'];

    // Secure search query
    $stmt = $conn->prepare("SELECT * FROM payment WHERE Customer_UserID = ?");
    $stmt->bind_param("i", $searchID);
    $stmt->execute();
    $results = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Grand Hotel | Search</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>SEARCH HISTORY</h2>
    <form method="GET" action="view_payment.php">
        <label>Enter Customer User ID</label>
        <input type="number" name="userID" value="<?= htmlspecialchars($searchID) ?>" required>
        <button type="submit" name="search">SEARCH RECORDS</button>
    </form>

    <?php if ($results && $results->num_rows > 0): ?>
        <table style="margin-top: 20px;">
            <tr>
                <th>Date</th>
                <th>Method</th>
                <th>Amount</th>
            </tr>
            <?php while($row = $results->fetch_assoc()): ?>
            <tr>
                <td><?= $row['PaymentDate'] ?></td>
                <td><?= $row['PaymentMethod'] ?></td>
                <td>Rs. <?= number_format($row['FinalPrice'], 2) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php elseif (isset($_GET['search'])): ?>
        <p style="text-align:center; margin-top:20px; color:red;">No records found for ID <?= htmlspecialchars($searchID) ?></p>
    <?php endif; ?>
    
    <a href="payment.php">View All Records</a>
</div>
</body>
</html>