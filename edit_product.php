<?php

require_once __DIR__ . "/db.php";

$id = $_GET["id"];

$sql = "SELECT * FROM products WHERE id = $id";

$result = mysqli_query($connection, $sql);

$product = mysqli_fetch_assoc($result);

if (!$product) {

    die("Product not found.");

}

if (isset($_POST["update"])) {

    $name = trim($_POST["name"]);
    $category = trim($_POST["category"]);
    $price = trim($_POST["price"]);
    $quantity = trim($_POST["quantity"]);
    $description = trim($_POST["description"]);

    if (
        $name == "" ||
        $category == "" ||
        $price == "" ||
        $quantity == "" ||
        $description == ""
    ) {

        $message = "Please fill in all fields.";

    } else {

        $sql = "UPDATE products SET
                name = '$name',
                category = '$category',
                price = '$price',
                quantity = '$quantity',
                description = '$description'
                WHERE id = $id";

        if (mysqli_query($connection, $sql)) {

            header("Location: index.php");
            exit;

        } else {

            $message = "Error updating product.";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Product</title>

    <link rel="stylesheet" href="Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container mt-5">

    <div class="form-container">

        <h1 class="mb-4">
            Edit Product
        </h1>

        <?php if (isset($message)) { ?>

            <div class="alert alert-danger">
                <?php echo $message; ?>
            </div>

        <?php } ?>

        <form method="POST">

            <div class="mb-3">

                <label class="form-label">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="<?php echo $product['name']; ?>"
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Category
                </label>

                <input
                    type="text"
                    name="category"
                    class="form-control"
                    value="<?php echo $product['category']; ?>"
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Price
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="price"
                    class="form-control"
                    value="<?php echo $product['price']; ?>"
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Quantity
                </label>

                <input
                    type="number"
                    name="quantity"
                    class="form-control"
                    value="<?php echo $product['quantity']; ?>"
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Description
                </label>

                <textarea
                    name="description"
                    class="form-control"
                    rows="4"
                ><?php echo $product['description']; ?></textarea>

            </div>

            <button
                type="submit"
                name="update"
                class="btn btn-success"
            >
                Update Product
            </button>

            <a
                href="index.php"
                class="btn btn-secondary"
            >
                Cancel
            </a>

        </form>

    </div>

</div>

<script src="Bootstrap/bootstrap.js"></script>

</body>

</html>