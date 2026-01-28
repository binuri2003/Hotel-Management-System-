<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../backend/login.php");
    exit();
}
include "../db/connection.php";

$message = "";


if (isset($_POST['reserve'])) {
    $roomId     = $_POST['room_id'];
    $checkIn    = $_POST['check_in'];
    $checkOut   = $_POST['check_out'];
    $customerId = 1; 

    
    $insertReservation = "
        INSERT INTO reserve (RoomID, CheckInDate, CheckOutDate, Customer_UserID)
        VALUES ('$roomId', '$checkIn', '$checkOut', '$customerId')
    ";

    if (mysqli_query($conn, $insertReservation)) {

        
        $updateRoom = "
            UPDATE room
            SET Status = 'Booked'
            WHERE RoomID = '$roomId'
        ";
        mysqli_query($conn, $updateRoom);

        $message = "Room reserved successfully";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}


$rooms = mysqli_query(
    $conn,
    "SELECT RoomID, RoomType, Price FROM room WHERE Status = 'Available'"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reserve Room</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="page-container">

    <div class="section">
        <h2>Reserve Room</h2>
    </div>

    <div class="section form-container">

        <?php if ($message != "") { ?>
            <p class="message"><?php echo $message; ?></p>
        <?php } ?>

        <form method="post">

            <label>Select Room</label>
            <select name="room_id" required>
                <option value="">-- Select Room --</option>
                <?php while ($row = mysqli_fetch_assoc($rooms)) { ?>
                    <option value="<?php echo $row['RoomID']; ?>">
                        <?php echo $row['RoomType']; ?> - Rs <?php echo $row['Price']; ?>
                    </option>
                <?php } ?>
            </select>

            <label>Check-in Date</label>
            <input type="date" name="check_in" required>

            <label>Check-out Date</label>
            <input type="date" name="check_out" required>

             <button type="submit" name="reserve">Reserve Room</button>

        </form>

    </div>

</div>

</body>
</html>
