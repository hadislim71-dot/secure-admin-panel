<?php

require_once "auth.php";
require_once __DIR__ . "/db.php";




$sql = "SELECT * FROM orders ORDER BY id DESC";

$result = mysqli_query($connection, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Orders</title>

    <link rel="stylesheet" href="Bootstrap/bootstrap.css">

</head>

<body>

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h1>
                Orders
            </h1>

            <a
                href="create_order.php"
                class="btn btn-primary">
                Create Order
            </a>

        </div>


        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                <?php while ($order = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>
                            <?php echo $order["id"]; ?>
                        </td>

                        <td>
                            <?php echo $order["customer"]; ?>
                        </td>

                        <td>
                            <?php echo $order["order_date"]; ?>
                        </td>

                        <td>
                            $<?php echo $order["total"]; ?>
                        </td>

                        <td>
                            <?php echo $order["status"]; ?>
                        </td>

                        <td>

                            <a
                                href="order_details.php?id=<?php echo $order['id']; ?>"
                                class="btn btn-info">
                                View Details
                            </a>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

    <div class="mt-5 mx-5">
        <a href="index.php"
            class="btn btn-secondary">Go Home
        </a>
    </div>
    <script src="Bootstrap/bootstrap.js"></script>

</body>

</html>