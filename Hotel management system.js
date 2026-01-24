// JS file for all pages

// ---------------- EXISTING CODE (UNCHANGED) ----------------

// Generate random Reservation ID
function generateReservationID() {
    return 'RES' + Math.floor(Math.random() * 100000);
}

// Reservation form validation
function validateReservationForm() {
    const customerID = document.getElementById('customerID').value;
    const roomID = document.getElementById('roomID').value;
    const checkIn = document.getElementById('checkIn').value;
    const checkOut = document.getElementById('checkOut').value;

    if (!customerID || !roomID || !checkIn || !checkOut) {
        alert("Please fill all required fields.");
        return false;
    }

    alert("Reservation Successful! Your Reservation ID: " + generateReservationID());
    return true;
}

// ---------------- NEW CODE (FOR HISTORY PAGE ONLY) ----------------

// Load reservation history from backend (MySQL)
function loadReservationHistory() {
    const tableBody = document.getElementById("historyTableBody");

    // Only run on history page
    if (!tableBody) return;

    fetch("getReservationHistory.php") // PHP file to fetch data from SQL
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = "";

            if (!data || data.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">No reservations found</td>
                    </tr>
                `;
                return;
            }

            data.forEach(res => {
                const row = `
                    <tr>
                        <td>${res.reservation_id}</td>
                        <td>${res.room_type}</td>
                        <td>${res.check_in}</td>
                        <td>${res.check_out}</td>
                        <td>${res.special_request || 'None'}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => {
            console.error("Error loading reservation history:", error);
            tableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center text-danger">
                        Failed to load reservation history
                    </td>
                </tr>
            `;
        });
}

// Run when page loads
document.addEventListener("DOMContentLoaded", loadReservationHistory);
