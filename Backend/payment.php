<?php
include 'connection.php'; 

date_default_timezone_set('Asia/Colombo'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $userID = $_POST['userID'];
    $orderID = $_POST['orderID'];
    $paymentMethod = $_POST['paymentMethod'];
    $finalPrice = $_POST['finalPrice'];
    $paymentDate = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("INSERT INTO payment (FinalPrice, PaymentDate, PaymentMethod, Customer_UserID, OrderID) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("dssii", $finalPrice, $paymentDate, $paymentMethod, $userID, $orderID);

    try {
        if ($stmt->execute()) {
            $last_id = $conn->insert_id; 
            
            header("Location: generate_bill.php?id=" . $last_id);
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>
                alert('Error: Customer ID $userID not found in database. Please register the customer first.');
                window.location.href='index.html';
              </script>";
    }

    $stmt->close();
}
$conn->close();


?>