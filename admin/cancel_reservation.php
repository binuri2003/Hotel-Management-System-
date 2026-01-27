<?php
include "../db/connection.php";

$message = "";


if (isset($_GET['reservation_id']) && isset($_GET['room_id'])) {

    $reservationId = $_GET['reservation_id'];
    $roomId        = $_GET['room_id'];

    $deleteReservation = "
        DELETE FROM reserve
        WHERE ReservationID = '$reservationId'
    ";

    if (mysqli_query($conn, $deleteReservation)) {

        
        $updateRoom = "
            UPDATE room
            SET Status = 'Available'
            WHERE RoomID = '$roomId'
        ";
        mysqli_query($conn, $updateRoom);

        $message = "Reservation cancelled successfully";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}


$reservations = mysqli_query(
    $conn,
    "SELECT r.ReservationID, r.RoomID, r.CheckInDate, r.CheckOutDate, rm.RoomType
     FROM reserve r
     JOIN room rm ON r.RoomID = rm.RoomID"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Reservation</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<div class="page-container">

    <div class="section">
        <h2>Manage Reservations</h2>
    </div>

    <?php if (!empty($message)) { ?>
        <p class="message"><?php echo $message; ?></p>
    <?php } ?>

    <div class="section table-container">
        <table>
            <tr>
                <th>Reservation ID</th>
                <th>Room ID</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Action</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($reservations)) { ?>
            <tr>
                <td><?php echo $row['ReservationID']; ?></td>
                <td><?php echo $row['RoomID']; ?></td>
                <td><?php echo $row['CheckInDate']; ?></td>
                <td><?php echo $row['CheckOutDate']; ?></td>
                <td>
                    <form method="post" onsubmit="return confirm('Cancel this reservation?');">
                        <input type="hidden" name="reservation_id" value="<?php echo $row['ReservationID']; ?>">
                        <input type="hidden" name="room_id" value="<?php echo $row['RoomID']; ?>">
                        <button type="submit" name="cancel_reservation">Cancel</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

</body>

</html>
