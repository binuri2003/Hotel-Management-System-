document.addEventListener('DOMContentLoaded', () => {
    const paymentForm = document.getElementById('payForm');

    if(paymentForm) {
        paymentForm.addEventListener('submit', (event) => {
            const userID = document.getElementsByName('userID')[0].value;
            const finalPrice = document.getElementsByName('finalPrice')[0].value;

            if (parseFloat(finalPrice) <= 0) {
                alert("Please enter a valid amount greater than 0.");
                event.preventDefault(); 
                return;
            }

            const confirmMessage = `Grand Hotel Payment Confirmation:\n\nUser ID: ${userID}\nAmount: Rs. ${finalPrice}\n\nDo you wish to proceed?`;
            
            if (!confirm(confirmMessage)) {
                event.preventDefault(); 
            }
        });
    }
});