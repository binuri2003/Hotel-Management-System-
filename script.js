// Function to validate the registration form
function validateForm() {
    // Get values from the input fields
    var fname = document.forms["regForm"]["fname"].value;
    var lname = document.forms["regForm"]["lname"].value;
    var phone = document.forms["regForm"]["phone"].value;
    var pass = document.forms["regForm"]["password"].value;

    // Check if First Name is empty
    if (fname == "") {
        alert("First Name must be filled out");
        return false;
    }

    // Check if Phone Number is valid (Basic check for numbers)
    if (isNaN(phone)) {
        alert("Phone number must contain only digits");
        return false;
    }

    // Check Password Length
    if (pass.length < 5) {
        alert("Password is too short! It must be at least 5 characters.");
        return false;
    }

    return true; // If everything is okay, let the form submit
}