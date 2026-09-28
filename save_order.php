<?php

require_once __DIR__ . "/db.php";

$customer = trim($_POST["customer"]);
$quantities = $_POST["quantity"];

if ($customer == "") {

    die("Customer name is required.");

}


// Calculate total

$total = 0;

foreach ($quantities as $productId => $quantity) {

    $quantity = (int)$quantity;

    if ($quantity > 0) {

        $sql = "SELECT price FROM products WHERE id = $productId";

        $result = mysqli_query($connection, $sql);

        $product = mysqli_fetch_assoc($result);

        if ($product) {

            $total += $product["price"] * $quantity;

        }

    }

}


// Make sure something was selected

if ($total == 0) {

    die("Please select at least one product.");

}


// Create order

$sql = "INSERT INTO orders
        (customer, total, status)
        VALUES
        ('$customer', '$total', 'Pending')";

if (mysqli_query($connection, $sql)) {

    $orderId = mysqli_insert_id($connection);

} else {

    die("Error creating order.");

}


// Save order items

foreach ($quantities as $productId => $quantity) {

    $quantity = (int)$quantity;

    if ($quantity > 0) {

        $sql = "SELECT price FROM products
                WHERE id = $productId";

        $result = mysqli_query($connection, $sql);

        $product = mysqli_fetch_assoc($result);

        $price = $product["price"];


        $sql = "INSERT INTO order_items
                (order_id, product_id, quantity, price)
                VALUES
                ('$orderId', '$productId', '$quantity', '$price')";

        mysqli_query($connection, $sql);

    }

}


header("Location: orders.php");

exit;

?>