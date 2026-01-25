function generateReservationID() {
    return 'RES' + Math.floor(Math.random() * 100000);
}

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

function loadReservationHistory() {
    const tableBody = document.getElementById("historyTableBody");
    if (!tableBody) return; 

    const customerID = document.getElementById("customerIDInput").value.trim();
    if (!customerID) {
        alert("Please enter your Customer ID.");
        return;
    }

    fetch(`getReservationHistory.php?customerID=${customerID}`)
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = "";

            if (!data || data.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">No reservations found for Customer ID ${customerID}</td>
                    </tr>
                `;
                return;
            }

            data.forEach(res => {
                const row = `
                    <tr>
                        <td>${res.ReservationID}</td>
                        <td>${res.RoomID}</td>
                        <td>${res.CheckInDate}</td>
                        <td>${res.CheckOutDate}</td>
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

document.addEventListener("DOMContentLoaded", () => {
    const customerIDInput = document.getElementById("customerIDInput");
    if (customerIDInput && customerIDInput.value) loadReservationHistory();
});
