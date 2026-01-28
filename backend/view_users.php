<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

// Admin check
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM user");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="page-container">

    <div class="section">
        <h2 style="text-align:center;">User Management</h2>
    </div>

    <div class="section table-container">
        <table>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['UserID']; ?></td>
                <td><?= $row['FirstName']; ?></td>
                <td><?= $row['LastName']; ?></td>
                <td><?= $row['Email']; ?></td>
                <td><?= $row['Username']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>


</div>

</body>
</html>