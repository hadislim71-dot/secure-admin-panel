<?php

require_once "auth.php";
require_once __DIR__ . "/db.php";



$orderId = $_GET["id"];


// Get order

$sql = "SELECT * FROM orders
        WHERE id = $orderId";

$result = mysqli_query($connection, $sql);

$order = mysqli_fetch_assoc($result);

if (!$order) {

    die("Order not found.");

}


// Get products in order

$sql = "SELECT
            order_items.*,
            products.name
        FROM order_items

        INNER JOIN products
        ON order_items.product_id = products.id

        WHERE order_items.order_id = $orderId";

$result = mysqli_query($connection, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order Details</title>

    <link rel="stylesheet" href="Bootstrap/bootstrap.css">

</head>

<body>

<div class="container py-5">

    <h1 class="mb-4">
        Order #<?php echo $order["id"]; ?>
    </h1>


    <div class="card mb-4">

        <div class="card-body">

            <p>
                <strong>Customer:</strong>
                <?php echo $order["customer"]; ?>
            </p>

            <p>
                <strong>Date:</strong>
                <?php echo $order["order_date"]; ?>
            </p>

            <p>
                <strong>Status:</strong>
                <?php echo $order["status"]; ?>
            </p>

            <p>
                <strong>Total:</strong>
                $<?php echo $order["total"]; ?>
            </p>

        </div>

    </div>


    <h3 class="mb-3">
        Products
    </h3>


    <table class="table table-bordered">

        <thead>

            <tr>

                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>

            </tr>

        </thead>

        <tbody>

            <?php while ($item = mysqli_fetch_assoc($result)) { ?>

                <tr>

                    <td>
                        <?php echo $item["name"]; ?>
                    </td>

                    <td>
                        <?php echo $item["quantity"]; ?>
                    </td>

                    <td>
                        $<?php echo $item["price"]; ?>
                    </td>

                    <td>
                        $<?php echo $item["price"] * $item["quantity"]; ?>
                    </td>

                </tr>

            <?php } ?>

        </tbody>

    </table>


    <a
        href="orders.php"
        class="btn btn-secondary"
    >
        Back to Orders
    </a>

</div>

<script src="Bootstrap/bootstrap.js"></script>

</body>

</html>