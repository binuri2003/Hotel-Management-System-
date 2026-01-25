<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "hotel_management_system");
if (!$conn) {
    echo json_encode([]);
    exit;
}

$customerID = isset($_GET['customerID']) ? intval($_GET['customerID']) : 0;

if ($customerID <= 0) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT ReservationID, RoomID, CheckInDate, CheckOutDate, special_request 
        FROM reserve 
        WHERE Customer_UserID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $customerID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$reservations = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reservations[] = $row;
}

echo json_encode($reservations);

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
