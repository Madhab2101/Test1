<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $itemQuantity = $_POST['item_quantity'];
    $price = $_POST['price'];

    // Check if the item already exists in the database
    $checkSql = "SELECT * FROM items WHERE name = '$name'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        // Item already exists, display message on add_item_form.php
        header("Location: add_item_form.php?message=Item%20already%20available%20in%20the%20database.");
        exit();
    } else {
        // Item does not exist, insert as new data
        $insertSql = "INSERT INTO items (name, quantity, price) VALUES ('$name', $itemQuantity, $price)";

        if ($conn->query($insertSql) === TRUE) {
            // Item added successfully, display message on add_item_form.php
            header("Location: add_item_form.php?message=Item%20added%20successfully");
            exit();
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
