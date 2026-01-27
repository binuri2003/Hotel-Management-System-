<?php
session_start();
include "../db/connection.php";

$message = "";

if (isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "
        SELECT u.UserID 
        FROM user u
        INNER JOIN admin a ON u.UserID = a.UserID
        WHERE u.Username = '$username' AND u.Password = '$password'
    ";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $row['UserID'];
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Invalid admin credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="page-container">

    <div class="section">
        <h2 style="text-align:center;">Admin Login</h2>
    </div>

    <div class="section form-container">

        <?php if ($message != "") { ?>
            <p class="message"><?php echo $message; ?></p>
        <?php } ?>

        <form method="post">
            <div>
                <label>Username</label><br>
                <input type="text" name="username" required>
            </div>

            <div>
                <label>Password</label><br>
                <input type="password" name="password" required>
            </div>

            <button type="submit" name="admin_login">Login</button>
        </form>

    </div>

</div>

</body>
</html>
