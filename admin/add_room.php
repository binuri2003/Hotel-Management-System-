<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../backend/login.php");
    exit();
}
include "../db/connection.php";

$message = "";

if (isset($_POST['add_room'])) {
    $roomType = $_POST['room_type'];
    $price    = $_POST['price'];

    $sql = "INSERT INTO room (RoomType, Price, Status, Customer_UserID, Admin_UserID)
            VALUES ('$roomType', '$price', 'Available', NULL, NULL)";

    if (mysqli_query($conn, $sql)) {
        $message = "Room added successfully";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="page-container">

    <div class="section">
        <h2>Add Room</h2>
    </div>

    <div class="section form-container">

        <?php if ($message != "") { ?>
            <p class="message"><?php echo $message; ?></p>
        <?php } ?>

        <form method="post">
            <label>Room Type</label>
            <input type="text" name="room_type" required>

            <label>Price</label>
            <input type="number" name="price" required>

            <button type="submit" name="add_room">Add Room</button>
        </form>

    </div>

</div>

</body>
</html>
