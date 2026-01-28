const foods = {
    "001": { name: "Bun", price: 300 },
    "002": { name: "Rice & Curry", price: 250 },
    "003": { name: "Egg Roti", price: 180 },
    "004": { name: "Hoppers", price: 220 },
    "005": { name: "String Hoppers", price: 230 },
    "006": { name: "Milk Rice", price: 200 },
    "007": { name: "Rice & Curry", price: 300 },
    "008": { name: "Chicken Biriyani", price: 450 },
    "009": { name: "Vegetable Biriyani", price: 400 },
    "010": { name: "Noodles", price: 350 },
    "011": { name: "Fried Rice", price: 380 },
    "012": { name: "Kottu (Chicken)", price: 420 },
    "013": { name: "Kottu (Vegetable)", price: 350 },
    "014": { name: "Noodles", price: 330 },
    "015": { name: "Burger", price: 300 },
    "016": { name: "Submarine Sandwich", price: 320 },
    "017": { name: "Pizza Slice", price: 280 },
    "018": { name: "Chicken Shawarma", price: 350 },
    "019": { name: "Milk Tea", price: 120 },
    "020": { name: "Coffee", price: 150 },
    "021": { name: "Fresh Lime Juice", price: 180 },
    "022": { name: "Orange Juice", price: 200 }
};

function generateBill() {
    const roomID = document.getElementById("roomID").value;
    const foodID = document.getElementById("foodID").value;
    const qty = parseInt(document.getElementById("qty").value);

    if (!foods[foodID]) {
        alert("Invalid Food ID");
        return false;
    }

    const price = foods[foodID].price * qty;

    document.getElementById("billBody").innerHTML = `
        <tr>
            <td>${roomID}</td>
            <td>${foods[foodID].name}</td>
            <td>${qty}</td>
            <td>Rs. ${price}</td>
        </tr>
    `;

    document.getElementById("total").innerText = "Rs. " + price;
    document.getElementById("total_price").value = price;

    return true; // SEND TO PHP
}