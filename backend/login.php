<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'config.php';

$error = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE Username='$username' AND Password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);
        $userId = $row['UserID'];

        $_SESSION['user_id'] = $userId;

        $checkAdmin = mysqli_query(
            $conn,
            "SELECT * FROM admin WHERE UserID = $userId"
        );

        if (mysqli_num_rows($checkAdmin) > 0) {
            $_SESSION['user_type'] = 'admin';
            header("Location: ../admin/dashboard.php");
            exit();
        } else {
            $_SESSION['user_type'] = 'customer';
            header("Location: ../customer/dashboard.php");
            exit();
        }

    } else {
        $error = "Invalid username or password";
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

<div class="login-container">

    <div class="login-box">
        <h2>Admin Login</h2>

        <?php if ($error != "") { ?>
            <p class="error-msg"><?php echo $error; ?></p>
        <?php } ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>

            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>

</div>

</body>
</html>
