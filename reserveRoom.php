<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "hotel_management_system");
if (!$conn) {
    die("❌ Database connection failed: " . mysqli_connect_error());
}

$customerID = mysqli_real_escape_string($conn, $_POST['customerID']);
$roomID     = mysqli_real_escape_string($conn, $_POST['roomID']);
$checkIn    = mysqli_real_escape_string($conn, $_POST['checkIn']);
$checkOut   = mysqli_real_escape_string($conn, $_POST['checkOut']);
$specialReq = mysqli_real_escape_string($conn, $_POST['specialReq']);

$checkRoomSQL = "SELECT * FROM room WHERE RoomID = '$roomID'";
$result = mysqli_query($conn, $checkRoomSQL);

if (!$result) {
    die("❌ Room check error: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 0) {
    die("❌ Room ID does not exist.");
}

$room = mysqli_fetch_assoc($result);

if ($room['Status'] === 'reserved') {
    die("❌ Room is already reserved.");
}

$insertReservationSQL = "
INSERT INTO reserve (RoomID, CheckInDate, CheckOutDate, Customer_UserID, special_request)
VALUES ('$roomID', '$checkIn', '$checkOut', '$customerID', '$specialReq')
";

if (!mysqli_query($conn, $insertReservationSQL)) {
    die("❌ Reservation failed: " . mysqli_error($conn));
}

$updateRoomSQL = "UPDATE room SET Status = 'reserved', Customer_UserID = '$customerID' WHERE RoomID = '$roomID'";
if (!mysqli_query($conn, $updateRoomSQL)) {
    die("❌ Room status update failed: " . mysqli_error($conn));
}

echo "✅ Room reserved successfully!";
?>
