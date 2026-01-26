<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE Username='$username' AND Password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);
        $userId = $row['UserID'];

        // Save user id in session
        $_SESSION['user_id'] = $userId;

        // 🔹 ADMIN CHECK (VERY IMPORTANT)
        $checkAdmin = mysqli_query(
            $conn,
            "SELECT * FROM admin WHERE UserID = $userId"
        );

        if (mysqli_num_rows($checkAdmin) > 0) {
            $_SESSION['user_type'] = 'admin';
            echo "Login successful - ADMIN";
        } else {
            $_SESSION['user_type'] = 'customer';
            echo "Login successful - CUSTOMER";
        }

    } else {
        echo "Invalid username or password";
    }
}
?>
