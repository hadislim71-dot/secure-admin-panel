
<?php

require_once __DIR__ . "/db.php";

$sql = "SELECT * FROM products";

$result = mysqli_query($connection, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Order</title>

    <link rel="stylesheet" href="Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container py-5">

    <h1 class="mb-4">
        Create Order
    </h1>

    <form action="save_order.php" method="POST">

        <!-- Customer -->

        <div class="mb-4">

            <label class="form-label">
                Customer Name
            </label>

            <input
                type="text"
                name="customer"
                class="form-control"
                required
            >

        </div>


        <h3 class="mb-3">
            Select Products
        </h3>


        <?php while ($product = mysqli_fetch_assoc($result)) { ?>

            <div class="card mb-3">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col-md-4">

                            <strong>
                                <?php echo $product["name"]; ?>
                            </strong>

                            <br>

                            $<?php echo $product["price"]; ?>

                        </div>


                        <div class="col-md-4">

                            <label>
                                Quantity
                            </label>

                            <input
                                type="number"
                                name="quantity[<?php echo $product['id']; ?>]"
                                class="form-control"
                                value="0"
                                min="0"
                            >

                        </div>

                    </div>

                </div>

            </div>

        <?php } ?>


        <button
            type="submit"
            class="btn btn-primary"
        >
            Save Order
        </button>

        <a
            href="orders.php"
            class="btn btn-secondary"
        >
            View Orders
        </a>

    </form>

</div>

<script src="Bootstrap/bootstrap.js"></script>

</body>

</html>