<?php
include "../db/connection.php";

$message = "";


if (isset($_POST['add_item'])) {
    $itemName     = $_POST['item_name'];
    $itemQuantity = $_POST['item_quantity'];

    $sql = "INSERT INTO inventory (ItemName, ItemQuantity, Supplier_UserID)
            VALUES ('$itemName', '$itemQuantity', NULL)";

    if (mysqli_query($conn, $sql)) {
        $message = "Inventory item added successfully";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}


if (isset($_POST['update_quantity'])) {
    $inventoryId  = $_POST['inventory_id'];
    $newQuantity  = $_POST['new_quantity'];

    $sql = "UPDATE inventory
            SET ItemQuantity = '$newQuantity'
            WHERE InventoryID = '$inventoryId'";

    if (mysqli_query($conn, $sql)) {
        $message = "Quantity updated successfully";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
$inventory = mysqli_query($conn, "SELECT * FROM inventory");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>





<div class="page-container">

    <div class="section">
    <h2>Inventory Management</h2>
</div>


    <div class="section form-container">
    <h3>Add Inventory Item</h3>

    <?php if ($message != "") { ?>
        <p class="message"><?php echo $message; ?></p>
    <?php } ?>

    <form method="post">
        <div>
            <label>Item Name</label><br>
            <input type="text" name="item_name" required>
        </div>

        <div>
            <label>Quantity</label><br>
            <input type="number" name="item_quantity" required>
        </div>

        <button type="submit" name="add_item">Add Item</button>
    </form>
</div>

    <div class="section table-container">
        <h3>Inventory List</h3>

        <table>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Update Quantity</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($inventory)) { ?>
            <tr>
                <td><?php echo $row['InventoryID']; ?></td>
                <td><?php echo $row['ItemName']; ?></td>
                <td><?php echo $row['ItemQuantity']; ?></td>
                <td>
                    <form method="post" style="display:flex; gap:8px; justify-content:center;">
                        <input type="hidden" name="inventory_id" value="<?php echo $row['InventoryID']; ?>">
                        <input type="number" name="new_quantity" required style="width:80px;">
                        <button type="submit" name="update_quantity">Update</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>

</div>

</body>


</html>
