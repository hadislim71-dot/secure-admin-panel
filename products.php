<?php

require_once "auth.php";
require_once __DIR__ . "/db.php";


$sql = "SELECT * FROM products";
$result = mysqli_query($connection, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product Management</title>

    <link rel="stylesheet" href="Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container py-5">
    <h1 class="text-center mb-4">
        Product Management
    </h1>

    <div class="mb-4">
        <a href="add_product.php" class="btn btn-primary">
            Add Product
        </a>
    </div>

    <div class="row mb-4">

        <div class="col-md-6 mb-2">
            <input
                type="text"
                id="searchInput"
                class="form-control"
                placeholder="Search product..." >
        </div>

        <div class="col-md-6 mb-2">
            <select id="categoryFilter" class="form-select">
                <option value="all">All Categories</option>

                <option value="Electronics">Electronics</option>

                <option value="Accessories">Accessories</option>

                <option value="Audio">Audio</option>
            </select>
        </div>
    </div>


    <div class="row g-4" id="productContainer">

        <?php while ($product = mysqli_fetch_assoc($result)) { ?>

            <div
                class="col-12 col-md-6 col-lg-4 product-item"
                data-name="<?php echo strtolower($product['name']); ?>"
                data-category="<?php echo $product['category']; ?>"
            >

                <div class="card h-100">

                    <div class="card-body">

                        <h5 class="card-title">
                            <?php echo $product["name"]; ?>
                        </h5>

                        <p>
                            <strong>Category:</strong>
                            <?php echo $product["category"]; ?>
                        </p>

                        <p>
                            <strong>Price:</strong>
                            $<?php echo $product["price"]; ?>
                        </p>

                        <p>
                            <strong>Quantity:</strong>
                            <?php echo $product["quantity"]; ?>
                        </p>

                        <p>
                            <strong>Description:</strong>
                            <?php echo $product["description"]; ?>
                        </p>

                        <div class="mt-3">

                            <a
                                href="edit_product.php?id=<?php echo $product['id']; ?>"
                                class="btn btn-warning"
                            >
                                Edit
                            </a>

                            <a
                                href="delete_product.php?id=<?php echo $product['id']; ?>"
                                class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this product?');"
                            >
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <p id="noResults" class="text-center mt-4">
        No products found.
    </p>

</div>

<script src="Bootstrap/bootstrap.js"></script>
<script src="script.js"></script>
</body>
</html>