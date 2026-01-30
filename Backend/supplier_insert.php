<?php
// Include the database connection
include('connection.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting data from the Frontend form
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $username   = $_POST['username'];
    $password   = $_POST['password']; 
    $company    = $_POST['company_name'];
    $phone      = $_POST['phone'];

    // 1. Insert into 'user' table first (Foreign Key Requirement)
    $sql_user = "INSERT INTO user (FirstName, LastName, Email, Username, Password, Role) 
                 VALUES ('$first_name', '$last_name', '$email', '$username', '$password', 'Supplier')";

    if ($conn->query($sql_user) === TRUE) {
        $last_id = $conn->insert_id; // Get the UserID for the following tables

        // 2. Insert into 'supplier' and 'user_phonenumber' tables
        $sql_supplier = "INSERT INTO supplier (UserID, CompanyName) VALUES ('$last_id', '$company')";
        $sql_phone = "INSERT INTO user_phonenumber (UserID, PhoneNumber) VALUES ('$last_id', '$phone')";

        if ($conn->query($sql_supplier) === TRUE && $conn->query($sql_phone) === TRUE) {
            // SUCCESS: Show alert and REDIRECT back to Frontend
            echo "<script>
                    alert('Supplier Added Successfully!');
                    window.location.href = '../Frontend/add_supplier.html';
                  </script>";
        } else {
            echo "Error linking profile: " . $conn->error;
        }
    } else {
        echo "Error creating account: " . $conn->error;
    }
}
$conn->close();
?>