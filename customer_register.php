<?php
// --- PHP DATABASE LOGIC STARTS HERE ---

// 1. Connection Variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_db";

// 2. Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// 3. Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// 4. If the form was submitted (User clicked Register)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get data from HTML inputs
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $user_name = $_POST['username'];
    $pass = $_POST['password']; 

    // SQL 1: Insert into USER (Superclass)
    $sql_user = "INSERT INTO USER (FirstName, LastName, Email, Address, Username, Password) 
                 VALUES ('$fname', '$lname', '$email', '$address', '$user_name', '$pass')";

    if ($conn->query($sql_user) === TRUE) {
        $new_id = $conn->insert_id; // Get the ID generated

        // SQL 2: Insert into USER_PhoneNumber
        $sql_phone = "INSERT INTO USER_PhoneNumber (UserID, PhoneNumber) VALUES ('$new_id', '$phone')";
        $conn->query($sql_phone);

        // SQL 3: Insert into CUSTOMER (Subclass)
        $sql_customer = "INSERT INTO CUSTOMER (UserID) VALUES ('$new_id')";
        
        if ($conn->query($sql_customer) === TRUE) {
            $message = "<div class='alert alert-success'>Registration Successful! Welcome, Guest #$new_id</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error linking customer: " . $conn->error . "</div>";
        }

    } else {
        $message = "<div class='alert alert-danger'>Error creating user: " . $conn->error . "</div>";
    }
}
// --- PHP LOGIC ENDS HERE ---
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Grand Hotel</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    
    <script src="script.js"></script>
</head>
<body>

    <div class="register-container">
        <div class="register-card">
            <h2 class="form-title">Guest Registration</h2>

            <?php echo $message; ?>

            <form name="regForm" method="post" action="" onsubmit="return validateForm()">
                
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="fname" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lname" class="form-control" required>
                    </div>
                </div>

                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>

                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" required>

                <label class="form-label">Home Address</label>
                <input type="text" name="address" class="form-control" required>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-gold-solid" style="margin-top: 20px;">
                    REGISTER NOW
                </button>
                
                <div style="text-align: center; margin-top: 20px;">
                    <a href="index.html" style="color: #666; text-decoration: none;">← Back to Home</a>
                </div>

            </form>
        </div>
    </div>

</body>
</html>