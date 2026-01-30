function validateSupplierForm() {
    // Corrected the name references to match the HTML 'name' attributes
    let firstName = document.forms["supplierForm"]["first_name"].value;
    let email = document.forms["supplierForm"]["email"].value;
    let phone = document.forms["supplierForm"]["phone"].value;
    let password = document.forms["supplierForm"]["password"].value;

    if (firstName === "" || email === "" || phone === "" || password === "") {
        alert("Please fill all required fields");
        return false;
    }

    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        alert("Invalid email format");
        return false;
    }

    if (phone.length < 10) {
        alert("Phone number must be at least 10 digits");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
    }

    return true;
}