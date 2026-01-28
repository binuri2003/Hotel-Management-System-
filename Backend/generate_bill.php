<?php
include 'connection.php';

$paymentID = $_GET['id'];


$sql = "SELECT p.*, c.Name 
        FROM payment p 
        JOIN customer c ON p.Customer_UserID = c.UserID 
        WHERE p.PaymentID = $paymentID";

$result = $conn->query($sql);
$bill = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grand Hotel - Official Bill</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .bill-box { border: 2px solid #143128; padding: 20px; max-width: 400px; margin: 50px auto; background: white; color: #333; }
        .bill-header { text-align: center; color: #143128; border-bottom: 2px solid #d4af37; margin-bottom: 20px; }
        .row { display: flex; justify-content: space-between; margin: 10px 0; }
        .total { font-weight: bold; font-size: 1.2em; color: #143128; border-top: 1px solid #ccc; padding-top: 10px; }
        .print-btn { background: #d4af37; color: white; padding: 10px; border: none; cursor: pointer; width: 100%; margin-top: 20px; }
    </style>
</head>
<body style="background-color: #143128;"> <div class="bill-box">
        <div class="bill-header">
            <img src="logo.jpg.jpeg" width="100" alt="Logo"> <h2>OFFICIAL RECEIPT</h2>
        </div>
        
        <div class="row"><span>Receipt No:</span> <b>#<?php echo $bill['PaymentID']; ?></b></div>
        <div class="row"><span>Date:</span> <?php echo $bill['PaymentDate']; ?></div>
        <hr>
        <div class="row"><span>Customer:</span> <?php echo $bill['Name']; ?></div>
        <div class="row"><span>Order ID:</span> <?php echo $bill['OrderID']; ?></div>
        <div class="row"><span>Method:</span> <?php echo $bill['PaymentMethod']; ?></div>
        <div class="row total"><span>Total Paid:</span> Rs. <?php echo number_format($bill['FinalPrice'], 2); ?></div>

        <button onclick="window.print()" class="print-btn">PRINT BILL</button>
        <p style="text-align:center;"><a href="index.html">Back to Portal</a></p>
    </div>
</body>
</html>